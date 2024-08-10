<?php

namespace App\Http\Controllers;

use App\Models\Apps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use Illuminate\Support\Facades\Storage;


class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.apps');
    }

    public function List(){
        $data=Apps::query();

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->inserted_at));
             })
         ->addColumn('view', function($data){
             return $data->views;
             })  
         ->addColumn('image', function($data){
             return '<a href="'.url('images/'.$data->image).'"><img src="'.url('images/'.$data->image).'" alt="An image" width="100" height="70"></a>';  
             })  
         ->addColumn('action', function($data){
             return '<div class="table-actions">
                     <a href="'.url('/apps/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>   
                     <button type="button" class="btn btn-danger remove-app" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
                 </div>';
         })
         ->addColumn('appurl', function($data){
            return '<a tagret="blank" href="'.url($data->appurl).'" style="color:blue;">View in App Store</a>';
            }) 
        ->addColumn('details', function($data){
            return '<p style="width:200px;"'.$data->details.'</p>';
            })           
         ->rawColumns(['DT_RowIndex','inserted_at','view','appurl','action','details','image'])      
           ->toJson();
    
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
            return redirect('/apps')->with('error',env('permission_msg'));
        }
        
        
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(150,150);
        $save= $image_resize->save('images/'.$fileNameToStore);
        
        if($save){
            $app= new Apps;
            $app->app_name=$request->name;
            $app->image=$fileNameToStore;
            $app->points=$request->coin;
            $app->url=$request->package;
            $app->appurl=$request->url;
            $app->details=$request->detail;
            $res=$app->save();
                if($res){
                    return redirect('/apps')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/apps/create')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/apps/create')->with('error', 'Technical Error Image!');
        } 
        // return true;
      }
  
  
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function edit(Apps $id)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/apps')->with('error',env('permission_msg'));
        }
        return view('app.edit-app',['data'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apps $apps)
    {
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
        $image_resize->resize(150,150);
        $save= $image_resize->save('images/'.$fileNameToStore);
        $icon=$fileNameToStore;
       }
       else
       {
        $icon=$request->oldicon; 
       }
       
       $app= Apps::find($request->id);
       $app->app_name=$request->name;
       $app->image=$icon;
       $app->points=$request->coin;
       $app->url=$request->package;
       $app->appurl=$request->url;
       $app->details=$request->detail;
       $res=$app->save();
           if($res){
               return redirect('/apps')->with('success', 'Update Successfully!');
           }else{
               return redirect('/apps')->with('error', 'Technical Error!');
           }  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        Apps::find($id)->delete();
        return 1;
    }
}
