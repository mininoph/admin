<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use File;


class Fun extends Controller
{
    public static function StoreImage($location,$width,$height,$req,$filename,$update){
        $image = $req->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = uniqid() . '_' . time() . '.' . $extension;
        $image_resize = Image::make($image->getRealPath());
        if($width!=null||$height!=null){
           $image_resize->resize($width,$height);
        }
        $save = $image_resize->save($location . $fileNameToStore);
        
        if($update){
            if($req->oldicon!=null )
            Fun::removeImage('/'.$location,$req->oldicon);
        }
        
        if($save){
            return $fileNameToStore;
        }else{
            return null;
        }
    }
    
    
    public static function removeImage($location,$filename){
        $image_path = $location.$filename;
        if($location!=null && $filename!=null){
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }
    
}    
    
   