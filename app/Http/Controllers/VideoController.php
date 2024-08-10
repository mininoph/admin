<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('video.video');
    }

    public function List(){
        $data=Video::get();

        return DataTables::of($data)
         ->addIndexColumn()
         ->addColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->insert_at));
             })
         ->addColumn('view', function($data){
             return $data->views;
             })  
         ->addColumn('video_id', function($data){
             return '<a href="'.$data->url.'" target="blank" >Watch Video</a>';
             })  
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                <a href="'.url('/videos/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>
                <button type="button" class="btn btn-danger remove-video" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';       
         })    
         ->rawColumns(['DT_RowIndex','inserted_at','view','video_id','action'])      
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
            return redirect('/videos')->with('error',env('permission_msg'));
        }


        if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->url, $match)){
            $youtube_id = $match[1];
        }else{
            $youtube_id=null;
        }
        
        $video= new VIdeo;
        $video->title=$request->name;
        $video->video_id=$youtube_id;
        $video->timer=$request->timer;
        $video->point=$request->point;
        $video->url=$request->url;
        $video->browser_type=$request->browser_type;
            $res=$video->save();
            if($res){
                return redirect('/videos')->with('success', 'Task Created Successfully!');
            }else{
                return redirect('/videos/create')->with('error', 'Technical Error!');
            }   
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $id)
    {
      return view('video.edit-video',['video'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/videos')->with('error',env('permission_msg'));
        }
        
        if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->url, $match)){
            $youtube_id = $match[1];
        }else{
            $youtube_id=null;
        }
        $video= VIdeo::find($request->id);
        $video->title=$request->name;
        $video->video_id=$youtube_id;
        $video->timer=$request->timer;
        $video->point=$request->point;
        $video->url=$request->url;
        $video->browser_type=$request->browser_type;
            $res=$video->save();
            if($res){
                return redirect('/videos')->with('success', 'Update Successfully!');
            }else{
                return redirect('/videos')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
  
 public function destroy($id)
 {
      if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
    Video::find($id)->delete();
     return 1;
 }
}
