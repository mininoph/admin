<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lang.index');
    }
    
    public function indexData()
    {
        $lang=DB::table('lang')->get();
        if(isset(request()->lang)){
              $data=DB::table('lang_text')->where('lang',request()->lang)->orderBy('type','ASC')->get();
        }else{
            $data=DB::table('lang_text')->where('lang','en')->orderBy('type','ASC')->get();
        }      
        
       // $data=DB::table('lang_text')->where('lang','en')->orderBy('type','ASC')->get();
        return view('lang.lang-data',['data'=>$data,'lang'=>$lang]);
    }
    
     public function List(){
         $data = DB::table('lang')
      ->orderBy('status','ASC');
      
      return Datatables::queryBuilder($data)
         ->addIndexColumn()
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
        ->addColumn('status', function($data){
             $status = $data->status;
            if($status ==0){
                return '<span class="badge badge-success m-1">Enabled</span>';
            }else{
                return '<span class="badge badge-danger m-1 status" id="0">Disabled</span>';  
            }
             })     
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-lang" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','image','status','action'])      
         ->make(true);    
    }

   

    public function edit($id)
    {
       return DB::table('lang')->where('id',$id)->first();
    }

   
    public function update(Request $request)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/language')->with('error',env('permission_msg'));
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
            $save= $image_resize->save('images/'.$fileNameToStore);
            $icon=$fileNameToStore;
            $imagePath = public_path('images/'.$request->oldimage);
            
        }
        else
        {
         $icon=$request->oldimage; 
        }
        
        $res= DB::table('lang')->where('id',$request->id)->update(['title'=>$request->title,'image'=>$icon,'status'=>$request->status]);
        if($res){
            return redirect('/language')->with('success', 'Update Successfully!');
        }else{
            return redirect('/language')->with('error', 'Technical Error!');
        }  
    }
    
    function updateLangText(Request $req){
        
      $count= count($req->lang_id);  
      
      for($i=0; $i<$count; $i++){
          DB::table('lang_text')->where('id',$req->lang_id[$i])->update(['txt_value'=>$req->langval[$i]]);
      }
        
      return redirect('/language/data?lang='.$req->selected_lang)->with('success', 'Update Successfully!');
    }


}
