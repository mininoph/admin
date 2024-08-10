<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class SocialController extends Controller
{
   
   function test(){
        
        
   }
   
    public function setCookie($val){
      $minutes = 60;
      $response = new Response('Set Cookie');
      $response->withCookie(cookie('stx', $val, $minutes));
    
   }
   
   public function List(){
        $data=Social::query();

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
         
         ->addColumn('url',function($data){
             return '<a target="blank" href="'.$data->url.'">'.$data->url.'</a>';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-social" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                 <button type="button" class="btn btn-danger remove-social" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','image','url','action'])      
         ->toJson();
    }
    
  
    public function store(Request $request)
    {
        
        if(auth()->user()->role_create=='false'){
            return redirect('/setting-general')->with('error',env('permission_msg'));
        }
        
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = uniqid().'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(200,200);
        $save= $image_resize->save('images/'.$fileNameToStore);

        if($save){
            $social= new Social;
            $social->title=$request->title;
            $social->image=$fileNameToStore;
            $social->url=$request->url;
            $res=$social->save();
                if($res){
                    return redirect('/setting-general')->with('success', 'Added Successfully!');
                }else{
                    return redirect('/setting-general')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/setting-general')->with('error', 'Technical Error Image!');
        } 
      }
      
    public function edit(Social $id){
        return $id;
    }  
  

    public function update(Request $request, Social $social)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/setting-general')->with('error',env('permission_msg'));
        }
        
        if(isset($request->icon))
        {
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = uniqid().'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,200);
            $save= $image_resize->save('images/'.$fileNameToStore);
            $icon=$fileNameToStore;
        }
        else
        {
         $icon=$request->oldicon; 
        }
        
        $social= Social::find($request->id);
        $social->title=$request->title;
        $social->image=$icon;
        $social->url=$request->url;
        $social->status=$request->status;
        $res=$social->save();
        
        if($res){
            return redirect('/setting-general')->with('success', 'Update Successfully!');
        }else{
            return redirect('/setting-general')->with('error', 'Technical Error!');
        }  
 
    }

    public function destroy($id)
    {
         if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        Social::find($id)->delete();
        return 1;
    }
}
