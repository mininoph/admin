<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use Illuminate\Support\Facades\Storage;
class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('redeem.redeem');
    }

    public function List(){
        $data=Redeem::query();

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/payment-options/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-redeem" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','image','action'])      
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
            return redirect('/payment-options')->with('error',env('permission_msg'));
        }
        
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        $save= $image_resize->save('images/'.$fileNameToStore);

        if($save){
            $redeem= new Redeem;
            $redeem->title=$request->name;
            $redeem->image=$fileNameToStore;
            $redeem->points=$request->coin;
            $redeem->description=$request->detail;
            $redeem->pointvalue=$request->currency;
            $redeem->hint=$request->hint;
            $redeem->input_type=$request->input_type;
            $res=$redeem->save();
                if($res){
                    return redirect('/payment-options')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/payment-options')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/payment-options')->with('error', 'Technical Error Image!');
        } 
      }
  
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function edit(Redeem $id)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/payment-options')->with('error',env('permission_msg'));
        }
        return view('redeem.edit-redeem',['redeem'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redeem $redeem)
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
            $save= $image_resize->save('images/'.$fileNameToStore);
             $icon=$fileNameToStore;
        }
        else
        {
         $icon=$request->oldimage; 
        }
        
        $redeem= Redeem::find($request->id);
        $redeem->title=$request->name;
        $redeem->image=$icon;
        $redeem->points=$request->coin;
        $redeem->hint=$request->hint;
        $redeem->input_type=$request->input_type;
        $redeem->description=$request->detail;
        $redeem->pointvalue=$request->currency;
        $res=$redeem->save();
            if($res){
                return redirect('/payment-options')->with('success', 'Update Successfully!');
            }else{
                return redirect('/payment-options')->with('error', 'Technical Error!');
            }  
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        Redeem::find($id)->delete();
        return 1;
    }
}
