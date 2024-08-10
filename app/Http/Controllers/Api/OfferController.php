<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Users;
use App\Models\TaskApi;
use App\Models\Video;
use App\Models\Apps;
use App\Models\Weblink;
use App\Models\Social;
use App\Models\Offerwall;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Auth;

class OfferController extends Controller
{
    
    function offerwall_credit($id,Request $req){
        
        $adminSetting=DB::table('admin_setting')->where('id',1)->get();   
        
        if($adminSetting[0]->offer_secret_key == $req->sign ){
            
            if($offerwall=Offerwall::where('id',$id)->first()){
                $userid=$req->query($this->clean($offerwall->p_userid));
                $coin=$req->query($this->clean($offerwall->p_payout));
                $offerid=$req->query($this->clean($offerwall->p_campaing_id));
                $usdAmount=$req->query($this->clean($offerwall->p_admin_payout));
                $offername=$req->query($this->clean($offerwall->p_offername));
                $ip=$req->query($this->clean($offerwall->p_ip));
                
                $cntra=DB::table('offerwall_earing')->where(['user_id' => $userid,'offerwall_id'=>$id,'survey_id' => $offerid])->count();
                
                if($cntra>0){
                    return ':Coin Already Credited';
                }
                
                if ($offername == "") {
                    $offername = "offer completed";
                }
                
                if ($ip == "") {
                    $ip = "blank";
                }
                
                if($user=Users::find($userid)){
                  
                  $total=$user->balance+$coin;
                  $user->balance=$total;
                  $user->save();
                  
                     DB::table('transaction')->insert([
                    'tran_type' => 'credit',
                    'user_id' => $userid,
                    'offer_id' => $offerid,
                    'amount' => $coin,
                    'ip' =>$ip,
                    'type' =>$offerwall->offerwall_slug,
                    'remained_balance' => $total,
                    'remarks' => $offerwall->offer_complete_title,
                    'admin_remarks' => $usdAmount." Admin Earned"
                    ]);
                
                    DB::table('offerwall_earing')->insert([
                        'earning'=>$usdAmount,
                        'offerwall_name'=>$offerwall->offerwall_slug,
                        'offerwall_id'=>$id,
                        'user_id'=>$userid,
                        'remark'=>$offerwall->offer_complete_title,
                        'survey_id'=>$offerid]);
                    
                    return $offerwall->response_code;
                    
                }else{
                   return 'Invalid Users';
                }
            
            }else{
                   return 'Invalid Offerwall';
                }
            
            
        }else{
            return 'Invalid Response';
        }
    }
    
    function clean($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      return preg_replace('/[^\w\-_]/', '', $string); // Removes special chars.
    }
}
