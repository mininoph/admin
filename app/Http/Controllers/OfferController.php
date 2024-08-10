<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Fun;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $setting = DB::table('setting')->where('id',1)->select('homepage')->get();
            
        return view('pages.homeoffer',['homestyle'=>$setting[0]->homepage]);
    }
    
     public function List(){
        $data=Offer::query()->orderBy('item_order','ASC');

        return DataTables::eloquent($data)
            ->addColumn('DT_RowIndex', function($data){
                 return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
                 })
            ->addColumn('offer_icon', function($data){
                return '<a href="'.url('images/'.$data->offer_icon).'" target="blank"><img src="'.url('images/'.$data->offer_icon).'" alt="" height="100px;"></a>';  
                 })     
            ->addColumn('status', function($data){
                 $status = $data->status;
                        if($status ==0){
                            return '<span class="badge badge-success ">Active</span>';
                        }else{
                            return '<span class="badge badge-danger" id="0">Disabled</span>';  
                        }
                 })     
             ->addColumn('action', function($data){
                    return '<div class="table-actions">
                        <button type="button" class="btn btn-success edit-offer" data-id="'.$data->id.'" offer_title="'.$data->offer_title.'" item_order="'.$data->item_order.'" offer_icon="'.$data->offer_icon.'" ><i class="ik ik-edit"></i>Edit</button>
                            </div>';
            
             })
             ->rawColumns(['DT_RowIndex','status','action','offer_icon'])      
             ->toJson();  
    }


    public function edit(Offer $id)
    {
       return $id;
    }

 
    public function update(Request $request, Offer $offer)
    {
        if(auth()->user()->role_create=='false'){
           return redirect('/offer')->with('error',env('permission_msg'));
        }
        
        if ($request->icon) {
            $filename =  Fun::StoreImage("images/", null, null, $request, "icon", true);
            if ($filename == null) {
                return redirect('/offer')->with('error', 'Technical Error in Image Upload');
            }
        } else {
            $filename = $request->oldicon;
        }
        
        $offer= Offer::find($request->id);
        $offer->offer_title=$request->offer_title;
        $offer->offer_title_hi=$request->offer_title_hi;
        $offer->offer_title_es=$request->offer_title_es;
        $offer->offer_title_tr=$request->offer_title_tr;
        $offer->offer_title_ar=$request->offer_title_ar;
        $offer->item_order=$request->item_order;
        $offer->offer_icon=$filename;
        $res=$offer->save();
            if($res){
                return redirect('/offer')->with('success', 'Update Successfully!');
            }else{
                return redirect('/offer')->with('error', 'Technical Error!');
            }  
    }

    public function action(Request $req)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Offer::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Offer::whereIn('id',explode(",",$ids))->update(array('status' =>1)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
