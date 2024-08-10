<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.game');
    }
    
     public function List(){
        $data=Game::get();

        return DataTables::of($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
        ->addColumn('link',function($data){
             return '<a href="'.$data->link.'" target="blank" class="text-primary">View Url</a>';
         })
          ->addColumn('played_user',function($data){
             return $data->played_user. ' Time Played';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-game" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                <button type="button" class="btn btn-danger remove-game" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','link','played_user','image','action'])      
         ->make(true);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->role_create=='false'){
            return redirect('/games')->with('error',env('permission_msg'));
        }
        
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(200,200);
        $save= $image_resize->save('images/'.$fileNameToStore);

        if($save){
            $game= new Game;
            $game->link=$request->link;
            $game->title=$request->title;
            $game->time=$request->time;
            $game->browser_type=$request->browser_type;
            $game->description=$request->description;
            $game->orientation=$request->orientation;
            $game->coin=$request->coin;
            $game->image=$fileNameToStore;
            $res=$game->save();
                if($res){
                    return redirect('/games')->with('success', ' Added Successfully!');
                }else{
                    return redirect('/games')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/games')->with('error', 'Technical Error Image!');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $id)
    {
       return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/games')->with('error',env('permission_msg'));
        }
        
        if(isset($request->icon))
        {
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,200);
            $save= $image_resize->save('images/'.$fileNameToStore);
             $icon=$fileNameToStore;
             $imagePath = public_path('images/'.$request->oldimage);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
        }
        else
        {
         $icon=$request->oldimage; 
        }
        
        $game= Game::find($request->id);
        $game->title=$request->title;
        $game->link=$request->link;
        $game->time=$request->time;
        $game->browser_type=$request->browser_type;
        $game->description=$request->description;
        $game->orientation=$request->orientation;
        $game->coin=$request->coin;
        $game->image=$icon;
        $res=$game->save();
            if($res){
                return redirect('/games')->with('success', 'Update Successfully!');
            }else{
                return redirect('/games')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        Game::find($id)->delete();
            return 1;
    }
    
    public function action(Request $req)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Slider::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Slider::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }else if($req->status=='delete'){
            $update =Slider::whereIn('id',explode(",",$ids))->delete();
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
