<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class Lib extends Controller
{
 
    public static function decrypt($data) {
        
        $key=DB::table('admin_setting')->where('id',1)->get()->first()->api_key;  
        
        $req=json_decode(base64_decode(base64_decode($data)),true); 
        
        if(base64_decode($req['dt_x_X']) != md5($req['ex_id'].'_'.$req['id'].'_'.$req['type'].'_'.$req['x_'].$key)) {
            return null;
        } 
          
        return $req;
    }
    
  
}