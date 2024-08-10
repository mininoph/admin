<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Classes\Base64;
use DB;
use Mail, GeoIP;
use Illuminate\Support\Str;
use File, Image;

class UserController extends Controller
{

    function index(Request $request)
    {
        $req = Auth\Lib::decrypt(urldecode(request()->data));

        if($req==null){
            return $this->respError(base64_decode($req['dt_x_X']).'   md5-'.md5($req['ex_id'].'_'.$req['id'].'_'.$req['type'].'_'.$req['x_'].$key));
        }
        
        if (env('cn') != "") {
            geoip()->getLocation(null);
            $ip = \Request::ip();
            $arr_ip = geoip()->getLocation($ip);

            $ar = explode(",", env('cn'));
            if (in_array($arr_ip->iso_code, $ar)) {
                return $this->respError(str_replace('_', ' ', env('msg')));
            }
        }

        if ($req['type'] == 0) {
            return $this->store($req);
        } else if ($req['type'] == 3) {
            return $this->storeGoogle($req);
        } else if ($req['type'] == 15) {
            return $this->fetch_coin($req);
        } else if ($req['type'] == 18) {
            return $this->send_Verfiyotp($req['ex_id']);
        } else if ($req['type'] == 19) {
            return $this->checkVerfied($req['ex_id']);
        } else if ($req['type'] == 20) {
            return $this->collectbonus($req);
        } else if ($req['type'] == 16) {
            return $this->removeUser($req['ex_id']);
        }


        if ($user = Users::where('email', $req['email'])->get()->first()) {

            if ($user->type == "google") {
                if ($user->uid != $req['randomString']) {
                    return $this->respError($this->getResponseMsg('something_went_wrong'));
                }
            } else {
                if (!Hash::check($req['password'], $user->password)) {
                    return $this->respError('Incorrent Password.');
                }
            }

            if ($user->status == 1) {
                return $this->respError($user->reason);
            }

            if ($user->uid == null) {
                Users::where('email', $req['email'])->update(['uid' => $this->generateuid()]);
                $user = Users::where('email', $req['email'])->first();
            }

            $user->tokens()->delete();
            $token = $user->createToken('my-app-token')->plainTextToken;
            $newtoken = base64_encode($token . $user->token);
            $response = [
                'user' => $user,
                'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                'code' => 201,
                'msg' => 'Login Success'
            ];

            return $response;
        } else {
            return  $this->respError('Email Not Found.');
        }
    }

    function generateuid()
    {
        $key = Str::random(8);

        if ($this->Exists($key)) {
            return generateuid();
        }
        return $key;
    }

    function Exists($key)
    {
        return Users::where('uid', $key)->exists();
    }

    public function genUserCode()
    {
        $this->refferal_id = [
            'refferal_id' => mt_rand(123456, 999999)
        ];

        $rules = ['refferal_id' => 'unique:customer'];

        $validate = Validator::make($this->refferal_id, $rules)->passes();

        return $validate ? $this->refferal_id['refferal_id'] : $this->genUserCode();
    }

    public function getUserIpAddr()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function store()
    {
         $req = Auth\Lib::decrypt(urldecode(request()->data));
        
        if($req==null){
            return $this->respError($this->getResponseMsg('something_went_wrong'));
        }
        $ip = $this->getUserIpAddr();

        if (!$this->isGmail($req['email'])) {
            return $this->respError($this->getResponseMsg('error_invalid_email'));
        }

        $userraw = DB::table('customer')->where(['ip' => $ip])->count();
        $appSetting = DB::table('app_setting')->where('id',1)->select('isVpn','one_device','one_ip')->get();

        if ($userraw >= $appSetting[0]->one_ip) {
            return  $this->respError($this->getResponseMsg('account_already_exist'));
        } else if ($appSetting[0]->one_device == "true" && $req['token']!=null) {
            if (DB::table('customer')->where(['token' => $req['token']])->count() > 0) {
                return $this->respError($this->getResponseMsg('account_already_exist_with').' '.DB::table('customer')->where('token',$req['token'])->get()->first()->email);
            }
        }

        if (DB::table('customer')->where(['name' => $req['name']])->count() > 0) {
            return $this->respError($this->getResponseMsg('username_taken'));
        } else if (DB::table('customer')->where(['email' => $req['email']])->count() > 0) {
            return $this->respError($this->getResponseMsg('email_taken'));
        } else if (DB::table('customer')->where(['phone' => $req['phone']])->count() > 0) {
            return $this->respError($this->getResponseMsg('phone_taken'));
        }

        $id = UserController::genUserCode();
        $uid=$this->generateuid();
        $user           = new Users;
        $user->uid      = $uid;
        $user->name     = $req['name'];
        $user->phone    = $req['phone'];
        $user->email    = $req['email'];
        $user->token    = $req['token'];
        $user->refferal_id = $id;
        $user->ip    = $ip;
        $user->balance  = 0;
        $user->password = Hash::make($req['password']);
        $res_user = $user->save();

        if ($res_user) {
            $user=Users::find($uid);
            $token = $user->createToken('my-app-token')->plainTextToken;
            $newtoken = base64_encode($token . $user->token);
           return $response = [
                'user' => $user,
                'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                'code' => 201,
                'msg' => 'Login Success'
            ];
        } else {
            return $this->respError($this->getResponseMsg('account_create_error'));
        }
    }

    public function storeGoogle()
    {
         $req = Auth\Lib::decrypt(urldecode(request()->data));
        
        if($req==null){
            return $this->respError($this->getResponseMsg('something_went_wrong'));
        }

        $ip = $this->getUserIpAddr();

        if ($user = Users::where('email', $req['email'])->get()->first()) {

            if ($user->type == "google") {
                if ($user->uid != $req['google']) {
                    return $this->respError($this->getResponseMsg('something_went_wrong'));
                }
            } else {
                return $this->respError($this->getResponseMsg('account_belong_to_other_login'));
            }

            if ($user->status == 1) {
                return $this->respError($user->reason);
            }

            if ($user->uid == null) {
                Users::where('email', $req['email'])->update(['uid' => $this->generateuid()]);
                $user = Users::where('email', $req['email'])->first();
            }

            $user->tokens()->delete();
            $token = $user->createToken('my-app-token')->plainTextToken;
            $newtoken = base64_encode($token . $user->token);
            $response = [
                'user' => $user,
                'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                'code' => 201,
                'msg' => 'Login Success'
            ];

            return response($response);
        } else {
            $userraw = DB::table('customer')->where(['ip' => $ip])->count();

            $appSetting = DB::table('app_setting')->where('id',1)->select('isVpn','one_device','one_ip')->get();

            if ($userraw >= $appSetting[0]->one_ip) {
                return  $this->respError($this->getResponseMsg('account_already_exist'));
            } else if ($appSetting[0]->one_device == "true" && $req['token']!=null) {
                if (DB::table('customer')->where(['token' => $req['token']])->count() > 0) {
                    return $this->respError($this->getResponseMsg('account_already_exist_with').' '.DB::table('customer')->where('token',$req['token'])->get()->first()->email);
                }
            }

             if (DB::table('customer')->where(['email' => $req['email']])->count() > 0) {
                return $this->respError($this->getResponseMsg('email_taken'));
            }

            $id = UserController::genUserCode();
            $user           = new Users;
            $user->uid      = $req['google'];
            $user->name     = $req['name'];
            $user->email    = $req['email'];
            $user->token    = $req['token'];
            $user->refferal_id = $id;
            $user->ip    = $ip;
            $user->balance  = 0;
            $user->type  = 'google';
            $res_user = $user->save();
            $user=Users::find($req['google']);

            if ($res_user) {
              //  $user->tokens()->delete();
                $token = $user->createToken('my-app-token')->plainTextToken;
                $newtoken = base64_encode($token . $user->token);
                $response = [
                    'user' => $user,
                    'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                    'code' => 201,
                    'msg' => 'Login Success'
                ];

                return response($response);
            } else {
                return $this->respError($this->getResponseMsg('account_create_error'));
            }
        }
    }

    public function fetch_coin($req)
    {
        $id = $req['ex_id'];
        $data = Users::find($id);
        if ($data) {
            return response(['balance' => $data->balance, 'code' => 1]);
        } else {
            return $this->respError('Account Not Credted !');
        }
    }

    public function reset(Request $request)
    {
        $appname = config('app.name');

        $valideator = Validator::make($request->all(), [
            'email'    => 'email|exists:customer'
        ], [
            'email.email' => $this->getResponseMsg('enter_email'),
            'email.exists' => 'Email Not Found !'
        ]);

        if ($valideator->fails()) {
            return response([
                'msg' => $valideator->errors()->first(), 'code' => 404
            ]);
        }

        $user = DB::table('customer')->where(['email' => $request->email, 'type' => 'google'])->count();
        if ($user > 0) {
            return $this->respError($this->getResponseMsg('account_connected_with_google'));
        }

        $token = Str::random(60);
        $otp = UserController::genUserCode();

        $details = [
            'title' => $appname,
            'body' => 'Your Password Reset OTP is  ' . $otp,
            'type' => 'pass'
        ];

        \Mail::to($request->email)->send(new \App\Mail\MyVerfiyMail($details));

        DB::table('password_reset')->insert(['email' => $request->email, 'token' => $token, 'otp' => $otp]);

        return $this->respOk($this->getResponseMsg('otp_sent_to_mail'));
    }

    public function verify(Request $req)
    {
        $otp = $req->otp;
        $dataotp = DB::table('password_reset')->where('email', $req->email)->orderBy('id', 'DESC')->limit(1)->get()->first()->otp;

        if ($otp == $dataotp) {
            return $this->respOk('Otp verified');
        } else {
            return $this->respError('Wrong OTP');
        }
    }

    public function update_password(Request $req)
    {
        $data = Users::where('email', $req->email)->get();
        $userid = $data[0]->uid;

        $dataotp = DB::table('password_reset')->where(['email' => $req->email, 'otp' => $req->otp])->whereDate('created_at', date('Y-m-d'))->limit(1)->count();
        if ($dataotp == 0) {
            return $this->respError('Session Exipred');
        }

        $update = Users::find($userid);
        $update->password = Hash::make($req->password);
        $update->save();
        if ($update) {
            return $this->respOk($this->getResponseMsg('password_update_login_now'));
        } else {
            return $this->respError($this->getResponseMsg('error_to_update_pass'));
        }
    }
    
    function update_profile(Request $request){
        if(auth('sanctum')->check()) {
            
       
            $userid = auth()->user()->uid;
            $req=json_decode(base64_decode(base64_decode(request()->data)),true); 
            
            $user=Users::find($userid);
            
            $fileNameToStore="";
            if ($request->newimage) {
                $image = $request->newimage;
                $filenameWithExt = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = uniqid() . '_' . time() . '.' . $extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save('images/user/' . $fileNameToStore);
                
                $user->profile=$fileNameToStore;
            }  
            
            if($user->email != $req['email']){
                $count=DB::table('customer')->where('email',$req['email'])->count();
                
                if($count>0){
                    return $this->respError($this->getResponseMsg('email_taken'));
                }
                
                 $user->email=$req['email'];
            }
            
            if($user->phone != $req['number']){
                $count=DB::table('customer')->where('phone',$req['number'])->count();
                
                if($count>0){
                    return $this->respError($this->getResponseMsg('phone_taken'));
                }
                                
                $user->phone=$req['number'];
            }
            
            $user->save();
            return response(['msg' => $this->getResponseMsg('profile_update_success'), 'code' => 201,'data'=>$fileNameToStore]);

           
        }else{
            return $this->respError($this->getResponseMsg('something_went_wrong'));
        }
    }
    
    
    
    function update_profile_pass(Request $request){
        if(auth('sanctum')->check()) {
            $userid = auth()->user()->uid;
            
            $req=json_decode(base64_decode(base64_decode(request()->data)),true); 
            
            $user=Users::find($userid);
            if($user->password == Hash::make($req['oldp'])){
                
                $user->password=Hash::make($req['newp']);
                $user->save();
                
                return $this->respOk($this->getResponseMsg('password_update_succes'));
                
            }else{
                return $this->respError($this->getResponseMsg('old_password_not_correc'));
            }
            
        }else{
            return $this->respError($this->getResponseMsg('something_went_wrong'));
        }    
    }


    function respError($msg)
    {
        return response(['msg' => $msg, 'code' => 404]);
    }

    function respOk($msg)
    {
        return response(['msg' => $msg, 'code' => 201]);
    }

    function respOk_($msg, $coin)
    {
        return response(['msg' => $msg, 'balance' => $coin, 'code' => 201]);
    }

    function send_Verfiyotp($email)
    {
        $appname = config('app.name');
        $token = Str::random(60);
        $otp = env('APP_URL') . 'verify/auth/' . $token . '/' . substr(md5(mt_rand()), 0, 7);

        $details = [
            'title' => $appname,
            'body' => '' . $otp
        ];



        try {
            \Mail::to($email)->send(new \App\Mail\MyTestMail($details));

            DB::table('password_reset')->insert(
                ['email' => $email, 'token' => $token, 'otp' => $otp]
            );

            return $this->respOk($this->getResponseMsg('email_has_been_sent_check_inbox'));
        } catch (Exception $e) {
            return $this->respError($this->getResponseMsg('something_went_wrong'));
        }
    }

    function send_otp(Request $request)
    {

        $appname = config('app.name');
        $token = Str::random(60);
        $otp = UserController::genUserCode();

        $details = [
            'title' => $appname,
            'body' => 'Your OTP is ' . $otp
        ];

        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

        DB::table('password_reset')->insert(
            ['email' => $request->email, 'token' => $token, 'otp' => $otp]
        );
        return $this->respOk($this->getResponseMsg('otp_sent_to_mail'));
    }

    public function verifyEmail($token, $enc)
    {
        $count = DB::table('password_reset')->where('token', $token)->count();
        if ($count == 0) {
            return 'Link Expired Login Again to Get New Link!.';
        }

        $info = DB::table('password_reset')->where('token', $token)->get();
        $user = DB::table('customer')->where('email', $info[0]->email)->get();

        if ($user[0]->emailVerified == "false") {
            $email = $info[0]->email;

            $verify = DB::table('customer')->where('email', $email)->update(['emailVerified' => date('Y-m-d')]);
            return 'Account Verified Successfully. close tab and Login to App!.';
        } else {
            return 'Account Already Verified. close tab and Login to App!.';
        }
    }

    public function collectbonus($req)
    {

        $user = Users::find($req['ex_id']);
        $fromRefer = $req['ex'];

            if($user->refferal_id==$fromRefer){
                return $this->respError($this->getResponseMsg('cant_use_self_refer'));
            }

            if ($user->from_refer <= 0) {
                if ($fromRefer != null) {
                   
                    if($fetchcoin = Users::where('refferal_id', $fromRefer)->first()){
                        $trns = DB::table('transaction')
                        ->insert([
                            'tran_type' => 'credit',
                            'user_id' => $req['ex_id'],
                            'amount' => env('bonus'),
                            'type' => 'welcome bonus',
                            'remained_balance' => $user->balance + env('bonus'),
                            'remarks' => 'Welcome Bonus'
                        ]);


                    $update = Users::find($fetchcoin->uid);
                    $update->balance = $fetchcoin->balance + env('ref');
                    $update->save();

                    $trnss = DB::table('transaction')
                        ->insert([
                            'tran_type' => 'credit',
                            'user_id' => $fetchcoin->uid,
                            'amount' => env('ref'),
                            'type' => 'Invite',
                            'remained_balance' => $fetchcoin->balance +  env('ref'),
                            'remarks' => $this->getResponseMsg('coin_credit_from').' ' . $user->name
                        ]);

                    $total = $user->balance + env('bonus');
                    $user->balance = $total;
                    $user->from_refer = $fromRefer;
                    $user->save();

                    return $this->respOk_($this->getResponseMsg('bonus_claim_success'), $total);
                    }else{
                        return $this->respError($this->getResponseMsg('enter_valid_refer_code'));
                    }
                } else {
                    $trns = DB::table('transaction')
                        ->insert([
                            'tran_type' => 'credit',
                            'user_id' => $req['ex_id'],
                            'amount' => env('bonus'),
                            'type' => 'Invite',
                            'remained_balance' => env('bonus'),
                            'remarks' => 'Welcome Bonus'
                        ]);
                    $total = $user->balance + env('bonus');
                    $user->balance = $total;
                    $user->from_refer = 1;
                    $user->save();

                    return $this->respOk_($this->getResponseMsg('bonus_claim_success'), $total);
                }
            } else {
                return $this->respError($this->getResponseMsg('bonus_already_claimed'));
            }
     
    }
    
    function getResponseMsg($key){
        $lang=(request()->header('lang')==null || request()->header('lang')=='') ? 'en' : request()->header('lang');
        return DB::table('lang_text')->where(['lang'=>$lang,'txt_key'=>$key])->get()->first()->txt_value;
    }

    function isGmail($email)
    {
        $email = trim($email); // in case there's any whitespace

        return mb_substr($email, -10) === '@gmail.com';
    }

    function checkVerfied($id)
    {
        $user = Users::find($id);

        if ($user->emailVerified == "false") {
            return $this->respError("Email is Not Verified");
        } else {
            return $this->respOk("Email Verified Successfully");
        }
    }

    public function removeUser($uid)
    {
      /*  Users::where('uid', $uid)->delete();
        DB::table('transaction')->where('user_id', $uid)->delete();
        DB::table('task')->where('user_id', $uid)->delete();*/

        return $this->respOk($this->getResponseMsg('something_went_wrong'));
    }
}
