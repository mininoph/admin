<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\HotOffer;
use App\Models\HotOfferData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use File;
use Illuminate\Support\Facades\Storage;


class HotOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hotoffer.index');
    }

    public function List(){
        $data=HotOffer::query();

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('created_at', function($data){
             return date('d-m-Y', strtotime($data->created_at));
             })
         ->addColumn('views', function($data){
             return $data->views.'/'.$data->task_limit;
             })  
         ->addColumn('image', function($data){
             return '<a href="'.url('images/'.$data->image).'"><img src="'.url('images/'.$data->image).'" alt="An image" width="200" height="100"></a>';  
             })  
         ->addColumn('action', function($data){
             return '<div class="table-actions">
                     <a href="'.url('/hotoffer/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>   
                     <button type="button" class="btn btn-danger remove-hotoffer" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
                 </div>';
         })
         ->addColumn('url', function($data){
            return '<a tagret="blank" href="'.url($data->url).'" style="color:blue;">View Link</a>';
            }) 
        ->addColumn('description', function($data){
            return '<p style="width:200px;"'.$data->description.'</p>';
            })           
         ->rawColumns(['DT_RowIndex','created_at','views','url','action','description','image'])      
           ->toJson();
    
    }
    
    public function ListPending(){
        $data=HotOfferData::query()->where('status',0);

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('created_at', function($data){
             return date('d-m-Y', strtotime($data->created_at));
         })
         
        ->addColumn('title', function($data){
               return '<span class="badge badge-success m-1">'.$data->title.'</span>';
         })

         ->addColumn('image', function($data){
             return '<a href="'.url('images/uploaded/'.$data->image).'"><img src="'.url('images/uploaded/'.$data->image).'" alt="An image" width="200" height="100"></a>';  
             }) 
         ->addColumn('username', function($data){
             return '<a href="'.url('/user/track/'.$data->user_id).'" style="color:blue;">'.$data->username.'</a>';  
             })  
         ->addColumn('action', function($data){
             return '<div class="table-actions">
                     <a href="'.url('/user/track/'.$data->user_id).'" ><button type="button" class="btn btn-dark" ><i class="ik ik-activity"></i>Track</button></a>   
                     <a href="'.url('/hotoffer/offer/approval/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Approve</button></a>   
                     <button type="button" class="btn btn-danger reject_hotoffer"  ><i class="ik ik-trash"></i>Reject & Delete</button>  
                 </div>';
         })

         
         ->rawColumns(['DT_RowIndex','created_at','action','username','title','image'])      
           ->toJson();
    
    }
    
    public function ListApproved(){
        $data=HotOfferData::query()->where('status',1);

        return DataTables::eloquent($data)
         ->addIndexColumn()
         ->addColumn('created_at', function($data){
             return date('d-m-Y', strtotime($data->created_at));
         })
         
        ->addColumn('title', function($data){
               return '<span class="badge badge-success m-1">'.$data->title.'</span>';
         })

         ->addColumn('image', function($data){
             return '<a href="'.url('images/uploaded/'.$data->image).'"><img src="'.url('images/uploaded/'.$data->image).'" alt="An image" width="200" height="100"></a>';  
             }) 
         ->addColumn('username', function($data){
             return '<a href="'.url('/user/track/'.$data->user_id).'" style="color:blue;">'.$data->username.'</a>';  
             })  
         ->addColumn('action', function($data){
             return '';
         })

         
         ->rawColumns(['DT_RowIndex','created_at','action','username','title','image'])      
           ->toJson();
    
    }
    
    public function store(Request $request)
    {
        if(auth()->user()->role_create=='false'){
            return redirect('/hotoffer')->with('error',env('permission_msg'));
        }
        
        
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = uniqid().'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        $save= $image_resize->save('images/'.$fileNameToStore);
        
        if($save){
            $offer= new HotOffer;
            $offer->image=$fileNameToStore;
            $offer->title=$request->title;
            $offer->description=$request->description;
            $offer->coin=$request->coin;
            $offer->url=$request->url;
            $offer->task_limit=$request->task_limit;
            $res=$offer->save();
                if($res){
                    return redirect('/hotoffer')->with('success', 'Created Successfully!');
                }else{
                    return redirect('/hotoffer/create')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/hotoffer/create')->with('error', 'Technical Error Image!');
        } 
      }
  
  
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function edit(HotOffer $id)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/hotoffer')->with('error',env('permission_msg'));
        }
        return view('hotoffer.edit',['data'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotOffer $offer)
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
        $icon=$request->oldicon; 
       }
       
        $offer= HotOffer::find($request->id);
        $offer->image=$icon;
        $offer->title=$request->title;
        $offer->description=$request->description;
        $offer->coin=$request->coin;
        $offer->url=$request->url;
        $offer->task_limit=$request->task_limit;
        $res=$offer->save();
           if($res){
               return redirect('/hotoffer')->with('success', 'Update Successfully!');
           }else{
               return redirect('/hotoffer')->with('error', 'Technical Error!');
           }  

    }
    
    
    function ApproveOffer($id){
        
        if($offer=HotOfferData::find($id)){
            if($offer->status==1){
                return redirect('/hotoffer/approval')->with('error','Offer Already Approved'); 
            }
            
            $task=DB::table('hot_offer')->where('id',$offer->task_id)->select('coin','image')->get();
            
            $user=Users::find($offer->user_id);
            $total=$user->balance+$task[0]->coin;
            $user->balance=$total;
            $user->save();
            
            DB::table('transaction')->insert([
                'tran_type' => 'credit',
                'user_id' => $offer->user_id,
                'amount' =>$task[0]->coin,
                'type' => 'Hotoffer',
                'remained_balance' => $total,
                'remarks' => $offer->title.' completed'
            ]);
            
            $offer->status=1;
            $offer->save();
            
            DB::table('global_msg')->insert([
                'user_id'=>$offer->user_id,
                'title'=>$offer->title,
                'message'=>DB::table('lang_text')->where(['lang'=>'en','txt_key'=>'hot_offer_approved'])->get()->first()->txt_value,
                'type'=>0,
                'image'=>'images/'.$task[0]->image,
                'dismiss'=>0
            ]);
            
            
            return redirect('/hotoffer/approval')->with('success','Offer Approved Successfully'); 
        }else{
            return redirect('/hotoffer/approval')->with('error','Offer Not Found'); 
        }
    }
    
    function RejectOffer(Request $req){
        $id=$req->id;
        if($offer=HotOfferData::find($id)){
            if($offer->status==1){
                return redirect('/hotoffer/approval')->with('error','Offer Already Approved'); 
            }
            
            $task=DB::table('hot_offer')->where('id',$offer->task_id)->select('coin','image')->get();
            
            try {
                $imagePath='images/uploaded/'.$offer->image;
                if(File::exists($imagePath)){
                       unlink($imagePath);
                }
            } 
            catch (\Exception $e) {}

           
            
            DB::table('global_msg')->insert([
                'user_id'=>$offer->user_id,
                'title'=>$offer->title.' Rejected',
                'message'=>$req->reason,
                'type'=>1,
                'image'=>'images/'.$task[0]->image,
                'dismiss'=>0
            ]);
                 
            $offer->delete();
            
            return redirect('/hotoffer/approval')->with('success','Offer Rejected Successfully'); 
        }else{
            return redirect('/hotoffer/approval')->with('error','Data Not Found'); 
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
        $offer=HotOffer::find($id);
        
        try {
            $imagePath='images/'.$offer->image;
             if(File::exists($imagePath)){
               unlink($imagePath);
            }
        } 
        catch (\Exception $e) {}

        $offer->delete();
        
        $data=DB::table('hotoffer_data')->where('task_id',$id)->get();
        
        for($i=0; $i<count($data); $i++){
            try {
                $imagePath='images/uploaded/'.$data[$i]->image;
                 if(File::exists($imagePath)){
                   unlink($imagePath);
                }
            } 
            catch (\Exception $e) {}
        }
        DB::table('hotoffer_data')->where('task_id',$id)->delete();
        return 1;
    }
}
