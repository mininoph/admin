<?php

namespace App\Http\Controllers;

use App\Models\Weblink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class WeblinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('web.website');
    }

    public function List(){
        $data=Weblink::get();

       return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('inserted_at', function($data){
            return date('d-m-Y', strtotime($data->inserted_at));
            })
        ->addColumn('view', function($data){
             return $data->views;
            })  
        ->addColumn('action', function($data){
            return '<div class="table-actions">
                <a href="'.url('/websites/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>
                <button type="button" class="btn btn-danger remove-web" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
              </div>';     
        })    
        ->rawColumns(['DT_RowIndex','inserted_at','view','action'])      
        ->make(true);    
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
            return redirect('/websites')->with('error',env('permission_msg'));
        }
        
       $weblink= new Weblink;
       $weblink->title=$request->title;
       $weblink->url=$request->url;
       $weblink->point=$request->point;
       $weblink->timer=$request->timer;
       $weblink->browser_type=$request->browser_type;
       $res=$weblink->save();

            if($res){
                return redirect ('/websites')->with('success','Data Added Successfully');
            }else{
                return redirect ('/websites')->with('error','Technical Error!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function show(Weblink $weblink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function edit(Weblink $id)
    {
       return view('web.edit-web',['web'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weblink $weblink)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/websites')->with('error',env('permission_msg'));
        }
        
        $weblink= Weblink::find($request->id);
       $weblink->title=$request->title;
       $weblink->url=$request->url;
       $weblink->point=$request->point;
       $weblink->timer=$request->timer;
       $weblink->browser_type=$request->browser_type;
       $res=$weblink->save();

            if($res){
                return redirect ('/websites')->with('success','Update Successfully');
            }else{
                return redirect ('/websites')->with('error','Technical Error!');
            } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        Weblink::find($id)->delete();
        return 1;
    }
}
