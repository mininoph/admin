<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File, Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('setting')->where('id',1)->get();
        return view('setting-general',['data'=>$data]);
    }
    
    public function ads(){
        $data=DB::table('setting')->where('id',1)->get();
        $ad = json_decode($data[0]->adConfig);
        return view('pages.setting-ads',['setting'=>$data,'ad'=>$ad]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->type=="general"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting-general')->with('error',env('permission_msg'));
            }
            
            if(isset($request->icon)){
                    
                    $image = $request->icon;
                    $filenameWithExt = $image->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                    $filename = preg_replace("/\s+/", '-', $filename);
                    $extension = $image->getClientOriginalExtension();
                    $fileNameToStore = 'favicon.png';
                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(80,80);
                      
                    $image_path = "/images/favicon.png";
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    
                    $save= $image_resize->save('images/'.$fileNameToStore);
                    $icon=$fileNameToStore;
                }else{
                  $fileNameToStore= $request->oldicon;
                }
            $data=['app_name'=>$request->app_name,
            'app_version'=> $request->version,
            'app_author'=> $request->author,
            'app_website'=> $request->website,
            'app_description'=> $request->detail,
            'privacy_policy'=> $request->privacy_policy,
            'app_email'=> $request->email,
            'app_icon'=>$fileNameToStore,
            'telegram'=> $request->telegram,
            'share_msg'=> $request->share_msg,
            'fb'=> $request->fb];
    
            $setting = DB::table('setting')->where('id',1)->update($data);
    
            return redirect('/setting-general')->with('success', 'Update Successfully!');
                  
        }
        else if($request->type=="ads"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/ads')->with('error',env('permission_msg'));
            }

            $adiD = array([
            'admob_app_id' => $request->admob_app_id,
            'admob_adtype' => $request->admob_adtype,
            'au_admob' => $request->au_admob,
            'fb_adtype' => $request->fb_adtype,
            'au_fb' => $request->au_fb,
            'applovin_adtype' => $request->applovin_adtype,
            'au_applovin' => $request->au_applovin,
            'unity_gameid' => $request->unity_gameid,
            'unity_adtype' => $request->unity_adtype,
            'au_unity' => $request->au_unity,
            'ironsource_key' => $request->ironsource_key,
            'iron_adtype' => $request->iron_adtype,
            
            'startio_id' => $request->startio_id,
            'ad_startio' => $request->ad_startio,
            'ad_not_load_credit' => $request->ad_not_load_credit]);
            
            $data=[
            'banner_type'=> $request->banner_type,
            'interstital_type'=> $request->interstital_type,
            'interstital_count'=> $request->interstital_count,
            'interstital_ID'=> $request->interstital_ID,
            'bannerid'=> $request->bannerid,
            'nativeId'=> $request->nativeId,
            'nativeCount'=> $request->nativeCount,
            'nativeType'=> $request->nativeType,
            'adConfig' => json_encode($adiD)
            ];
    
            $setting = DB::table('setting')->where('id',1)->update($data);
    
           return redirect('/setting/ads')->with('success', 'Update Successfully!');
           
            
        }else if($request->type=="update"){
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/app')->with('error',env('permission_msg'));
            }
            
            if($request->up_status=="on"){$up_status='true';}else{  $up_status='false'; }
            if($request->up_btn=="on"){ $up_btn='true';}else{  $up_btn='false'; }
            
           $datas=['up_status'=>$up_status,
            'up_mode'=> $request->up_mode,
            'up_version'=> $request->up_version,
            'up_msg'=> $request->up_msg,
            'up_link'=> $request->up_link,
            'up_btn'=> $up_btn];
    
            $setting = DB::table('setting')->where('id',1)->update($datas);
    
                if($setting){
                    return redirect('/setting/app')->with('success', 'Update Successfully!');
                }else{
                    return redirect('/setting/app')->with('error', 'Technical Error!');
                }   
        }
        else if($request->type=="secure"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/app')->with('error',env('permission_msg'));
            }
            
            if(isset($request->one_device)){
            if($request->one_device=="on"){$one_device='true';}else{ $one_device='false'; }
            }else{$one_device='false'; }
            
            if(isset($request->isVpn)){
            if($request->isVpn=="on"){$isVpn='true';}else{ $isVpn='false'; }
            }else{$isVpn='false'; }
            
            $setting = DB::table('app_setting')->where('id',1)->update([
                'isVpn'=>$isVpn,
                'one_device'=>$one_device,
                'one_ip'=>$request->one_ip,
                ]);

            \Artisan::call('config:clear');
        
         return redirect('/setting/app')->with('success', 'Update Successfully!');
            
        }
        else if($request->type=="smtp"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/app')->with('error',env('permission_msg'));
            }
            
             $this->updateData('MAIL_MAILER',$request->MAIL_MAILER);
             $this->updateData('MAIL_HOST',$request->MAIL_HOST);
             $this->updateData('MAIL_PORT',$request->MAIL_PORT);
             $this->updateData('MAIL_USERNAME',$request->MAIL_USERNAME);
             $this->updateData('MAIL_PASSWORD',$request->MAIL_PASSWORD);
             $this->updateData('MAIL_ENCRYPTION',$request->MAIL_ENCRYPTION);
             $this->updateData('MAIL_FROM_ADDRESS',$request->MAIL_USERNAME);
            
            \Artisan::call('config:clear');
            
             return redirect('/setting/app')->with('success', 'Update Successfully!');
        }else if($request->type=="cn"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/app')->with('error',env('permission_msg'));
            }
            
             $this->updateData('cn',$request->cn);
             $this->updateData('msg',str_replace(' ', '_',$request->msg));
            
            \Artisan::call('config:clear');
            
             return redirect('/setting/app')->with('success', 'Update Successfully!');
        }
        else if($request->type=="home"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/offer')->with('error',env('permission_msg'));
            }
            
            $setting = DB::table('setting')->where('id',1)->update([
                'homepage'=>$request->home_style
                ]);
            
             return redirect('/offer')->with('success', 'Update Successfully!');
        }
        else if($request->type=="noti"){
            
            if(auth()->user()->role_setting=='false'){
                return redirect('/setting/app')->with('error',env('permission_msg'));
            }
            
            $setting = DB::table('admin_setting')->where('id',1)->update([
                'onesignal_appid'=>$request->onesignal_appid,
                'onesignal_restapi'=>$request->onesignal_restapi
                ]);
            
             return redirect('/setting/app')->with('success', 'Update Successfully!');
        }
    }
  
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function spin(){
        $data= DB::table('wheel_points')->get();
        return view('pages.spin',['data'=>$data]);
    }

    public function spinupdate(Request $request){
        
        if(auth()->user()->role_setting=='false'){
                return redirect('/setting/spin')->with('error',env('permission_msg'));
         }
            
         $data=['position_1'=>$request->p_1,
         'position_2'=> $request->p_2,
         'position_3'=> $request->p_3,
         'position_4'=> $request->p_4,
         'position_5'=> $request->p_5,
         'position_6'=> $request->p_6,
         'position_7'=> $request->p_7,
         'position_8'=>  $request->p_8,
         'pc_1'=> $request->pc_1,
         'pc_2'=> $request->pc_2,
         'pc_3'=> $request->pc_3,
         'pc_4'=> $request->pc_4,
         'pc_5'=> $request->pc_5,
         'pc_6'=> $request->pc_6,
         'pc_7'=> $request->pc_7,
         'pc_8'=> $request->pc_8];

         $setting = DB::table('wheel_points')->where('id',1)->update($data);
             if($setting){
                 return redirect('/setting/spin')->with('success', 'Update Successfully!');
             }else{
                 return redirect('/setting/spin')->with('error', 'Technical Error!');
             } 

    }

    public function app(){
        $data= DB::table('app_setting')->get();
        $data1= DB::table('setting')->get();
        $admin= DB::table('admin_setting')->get();
        return view('pages.setting',['data'=>$data,'setting'=>$data1,'admin'=>$admin]);
    }

    public function appupdate(Request $request){
        
        if(auth()->user()->role_setting=='false'){
            return redirect('/setting/app')->with('error',env('permission_msg'));
         }

         $this->updateData('spn',$request->spin);
         $this->updateData('daily',$request->daily);
         $this->updateData('bonus',$request->bonus);
         $this->updateData('ref',$request->refer);
         $this->updateData('ref',$request->refer);
         $this->updateData('game',$request->game_coin);
         $this->updateData('mathLimit',$request->mathLimit);
     	 $this->updateData('scratch',$request->scratch);
      	 $this->updateData('scratch_coin',$request->scratch_coin);
         $this->updateData('mathCoin',$request->mathCoin);
         $this->updateData('app',$request->app);
         $this->updateData('video',$request->video);
         $this->updateData('web',$request->web);
        

         
        // \Artisan::call('config:cache');
        \Artisan::call('config:clear');
        
         return redirect('/setting/app')->with('success', 'Update Successfully!');
            
    }
    
    public static function updateData($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
       
    }
}
