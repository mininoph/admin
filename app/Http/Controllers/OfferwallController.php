<?php

namespace App\Http\Controllers;

use App\Models\Offerwall;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image,DB;

class OfferwallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('offerwall.index');
    }

    public function list()
    {
        $data = Offerwall::query();
         
        return DataTables::eloquent($data)
            ->addColumn('DT_RowIndex', function($data){
                 return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
                 })
            ->addColumn('thumb', function ($data) {
                return '<img src="' . url('images/' . $data->thumb) . '" alt="An image" height="100px">';
            })
            
             ->addColumn('offer_type', function($data){
                $offer_type = $data->offer_type;
                if($offer_type =='offers'){
                    return '<span class="badge badge-primary">Offerwall</span>';
                }else{
                    return '<span class="badge badge-warning">Surveys</span>';  
                }
            })  
                 
             ->addColumn('status', function($data){
                 $status = $data->status;
                        if($status ==0){
                            return '<span class="badge badge-success">Active</span>';
                        }else{
                            return '<span class="badge badge-danger">Disabled</span>';  
                        }
                 })  
                 
            ->addColumn('earning', function($data){
                    $offer=DB::select("SELECT SUM(earning) as income FROM offerwall_earing where offerwall_id=:ofr",['ofr'=>$data->id]);
                    if(empty($offer)){
                        return '<span class="badge badge-dark">$0</span>';
                    }else{
                        $earn=($offer[0]->income == '') ? '0' : $offer[0]->income;
                        return '<span class="badge badge-dark">$'.$earn.'</span>';
                    }
                 })  
                 
             ->addColumn('level', function($data){
                    return '<span class="badge badge-dark">'.$data->level.'</span>';
                 })  
                 
                 
            ->addColumn('action', function ($data) {
                $key=DB::table('admin_setting')->where('id',1)->get()->first()->offer_secret_key;
                $url=env('APP_URL').'api/v1/offer_cr/'.$data->id.'?sign='.$key.$data->postback_url;
                
                return '<div class="table-actions">
                 <button type="button" class="btn btn-info copy-postback" data-id="' . $url . '"  ><i class="ik ik-link"></i>View Postback</button>
                 <a href="' . url('/offerwall/edit/' . $data->id) . '" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>
                 <button type="button" class="btn btn-danger remove-offerwall" data-id="' . $data->id . '"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';
            })
            ->rawColumns(['DT_RowIndex','status','earning','offer_type','level','thumb', 'action'])
            ->toJson();
    }

    public function store(Request $req)
    {

        if (auth()->user()->role_create == 'false') {
            return redirect('/offerwall')->with('error', env('permission_msg'));
        }

        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required',
            'offerwall_slug' => 'required',
            'offerwall_url' => 'required',
            'level' => 'required',
            'offer_type' => 'required',
            'u_tag' => 'required',
            'uid_type' => 'required',
            'p_userid' => 'required',
            'p_payout' => 'required',
            'p_campaing_id' => 'required',
            'p_offername' => 'required',
            'response_code' => 'required',
            'offer_complete_title' => 'required',
            'item_order' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/offerwall/create')
                ->withErrors($validator)
                ->withInput();
        }

        $image = $req->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $image_resize = Image::make($image->getRealPath());
        $save = $image_resize->save('images/' . $fileNameToStore);

        if ($save) {

            if ($req->p_userid != "") { $puser = '' . $this->clean($req->p_userid).'='.$req->p_userid; } else { $puser = '';}
            if ($req->p_payout != "") {$pamount = '&' . $this->clean($req->p_payout).'='.$req->p_payout;} else { $pamount = '';}
            if ($req->p_offername != "") {$p_offername = '&' . $this->clean($req->p_offername).'='.$req->p_offername;} else { $p_offername = '';}
            if ($req->p_campaing_id != "") {$pofferid = '&' . $this->clean($req->p_campaing_id).'='.$req->p_campaing_id; } else { $pofferid = '';}
            if ($req->p_ip != "") {$pip = '&' . $this->clean($req->p_ip).'='.$req->p_ip;} else { $pip = '';}
            $domainURL = '&';

            $postback_url = $domainURL . $puser . $pamount . $pip . $pofferid . $p_offername;

            $offer = new Offerwall;
            $offer->title = $req->title;
            $offer->description = $req->description;
            $offer->offerwall_slug = str_replace(' ', '_', strtolower($req->offerwall_slug));
            $offer->thumb = $fileNameToStore;
            $offer->offerwall_url = $req->offerwall_url;
            $offer->level = $req->level;
            $offer->offer_type = $req->offer_type;
            $offer->u_tag = $req->u_tag;
            $offer->advid_tag = $req->advid_tag;
            $offer->card_color = $req->card_color;
            $offer->text_color = $req->text_color;
            $offer->browser_type = $req->browser_type;
            $offer->uid_type = $req->uid_type;
            $offer->p_userid = $req->p_userid;
            $offer->p_payout = $req->p_payout;
            $offer->p_campaing_id = $req->p_campaing_id;
            $offer->p_ip = $req->p_ip;
            $offer->p_offername = $req->p_offername;
            $offer->p_admin_payout = $req->p_admin_payout;
            $offer->response_code = $req->response_code;
            $offer->offer_complete_title = $req->offer_complete_title;
            $offer->postback_url = $postback_url;
            $offer->item_order = $req->item_order;
            $res = $offer->save();

            if ($res) {
              return  redirect('/offerwall')->with('success', 'Added SuccessFully!');
            } else {
              return  redirect('/offerwall')->with('error', 'Internal Error!');
            }

        } else {
            return redirect('/offerwall')->with('error', 'Technical Error Image!');
        }
    }


    public function edit(Offerwall $id)
    {
        if (auth()->user()->role_edit == 'false') {
            return redirect('/payment-options')->with('error', env('permission_msg'));
        }
        
         $network=null;
         if($id->type=='sdk'){
           $network = array();
            foreach (json_decode($id->offerwall_url) as $item) {
                array_push($network, ['name' => $item->key, 'value' => $item->value]);
            }
         }
        
        return view('offerwall.edit', ['offer' => $id,'offer_data'=>$network]);
    }
    
    
    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       return preg_replace('/[^\w\-_]/', '', $string); // Removes special chars.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Offerwall $offer)
    {
        if (isset($req->icon)) {
            $image = $req->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $image_resize = Image::make($image->getRealPath());
            $save = $image_resize->save('images/' . $fileNameToStore);
            $icon = $fileNameToStore;
        } else {
            $icon = $req->oldimage;
        }

            if ($req->p_userid != "") { $puser = '' . $this->clean($req->p_userid).'='.$req->p_userid; } else { $puser = '';}
            if ($req->p_payout != "") {$pamount = '&' . $this->clean($req->p_payout).'='.$req->p_payout;} else { $pamount = '';}
            if ($req->p_offername != "") {$p_offername = '&' . $this->clean($req->p_offername).'='.$req->p_offername;} else { $p_offername = '';}
            if ($req->p_campaing_id != "") {$pofferid = '&' . $this->clean($req->p_campaing_id).'='.$req->p_campaing_id; } else { $pofferid = '';}
            if ($req->p_ip != "") {$pip = '&' . $this->clean($req->p_ip).'='.$req->p_ip;} else { $pip = '';}
            if ($req->p_admin_payout != "") {$p_admin_payout = '&' . $this->clean($req->p_admin_payout).'='.$req->p_admin_payout;} else { $p_admin_payout = '';}
            $domainURL = '&';

            $postback_url = $domainURL . $puser . $pamount . $pip . $pofferid.$p_admin_payout . $p_offername;

            $offer = Offerwall::find($req->id);
            $offer->title = $req->title;
            $offer->description = $req->description;
            $offer->offerwall_slug = str_replace(' ', '_', strtolower($req->offerwall_slug));
            $offer->thumb = $icon;
            $offer->level = $req->level;
            $offer->offer_type = $req->offer_type;
           
            $offer->card_color = $req->card_color;
            $offer->text_color = $req->text_color;
            $offer->browser_type = $req->browser_type;
             
            if($offer->type=='sdk'){
                  $ofr = json_decode($offer->offerwall_url);
                    $data = array();
                    $val = $req->keyval;
                    $cnt =  count($val);
                    for ($i = 0; $i < $cnt; $i++) {
                        array_push($data, ['key' => $ofr[$i]->key, 'slug' => $ofr[$i]->slug, 'value' => $val[$i]]);
                    }
                 $offer->offerwall_url = $data;    
            }else{
                $offer->uid_type = $req->uid_type;
                $offer->p_userid = $req->p_userid;
                $offer->offerwall_url = $req->offerwall_url;
                $offer->u_tag = $req->u_tag;
                $offer->advid_tag = $req->advid_tag;
                $offer->item_order = $req->item_order;
            }
            $offer->p_payout = $req->p_payout;
            $offer->p_campaing_id = $req->p_campaing_id;
            $offer->p_ip = $req->p_ip;
            $offer->p_offername = $req->p_offername;
            $offer->p_admin_payout = $req->p_admin_payout;
            $offer->response_code = $req->response_code;
            $offer->offer_complete_title = $req->offer_complete_title;
            $offer->postback_url = $postback_url;
            
            $res = $offer->save();

            if ($res) {
                return redirect('offerwall')->with('success', 'Update SuccessFully!');
            } else {
               return redirect('/offerwall')->with('error', 'Internal Error!');
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
        if (auth()->user()->role_delete == 'false') {
            return env('permission_msg');
        }
        Offerwall::find($id)->delete();
        return 1;
    }
    
    function action(Request $req){
         if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Offerwall::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Offerwall::whereIn('id',explode(",",$ids))->update(array('status' =>1)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
