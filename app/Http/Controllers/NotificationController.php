<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Illuminate\Support\Facades\Storage;


class NotificationController extends Controller
{

   public function new(Request $req){
    
    $admin=DB::table('admin_setting')->where('id',1)->get();
    
        
        $title = $req->title;
	    $message = $req->message;
	    $link = $req->url;
	    
	    if(empty($message)){ $message=null; }
	    if(empty($link)){ $link=null; }
	    
	    if($req->image){
	        $image = $req->image;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,200);  
            $save= $image_resize->save('images/'.$fileNameToStore);
            
            $icon=env('APP_URL').'images/'.$fileNameToStore;
	    }else{
	        $icon=null;
	    }
	    
            
        if($message==null || empty($message)){
	     	 $content = array("en" => strip_tags($title));
	    }else{
	         $content = array("en" => strip_tags($message));
	    }
	    
 
        
        $fields = array(
        	'app_id' => $admin[0]->onesignal_appid,
        	'included_segments' => array('All'),                                            
        	'data' => array(
        		"link" => $link,
        		"description" => $message,
        		"img" => $icon
        	),
        	'headings'=> array("en" => $title),
        	'contents' =>$content,
        	'big_picture' =>  $icon
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.$admin[0]->onesignal_restapi));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

             return redirect('/notification')->with('success','Notification Send Successfully');


   }
}
