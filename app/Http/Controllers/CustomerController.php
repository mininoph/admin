<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use DataTables,Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Fun;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('users');
    }
    
    public function bannedindex()
    {
       return view('pages.ban-users');
    }
    
    

    public function getUserList($status){
          $data  = Users::query()->where('status','=',$status)->orderBy('cust_id', 'DESC');

           return Datatables::eloquent($data)
           ->addIndexColumn()
           ->addColumn('inserted_at', function($data){
                return date('d-m-Y', strtotime($data->inserted_at));
            })
          
            
            ->addColumn('profile', function($data){
                if($data->profile!=null){
                    
                   if (str_contains($data->profile, 'http') == true) {
                       return '<a href="'.url($data->profile).'" target="blank"><img src="'.url($data->profile).'" alt="" width="60" height="60" class="img-fluid img-80"></a>';  
                   }else{
                       return '<a href="'.url('images/user/'.$data->profile).'" target="blank"><img src="'.url('images/user/'.$data->profile).'" alt=""  class="img-fluid img-80" width="60" height="60"></a>';  
                   }
                }else{
                    return '<a href="'.url('img/user3.jpg').'" target="blank"><img src="'.url('img/user3.jpg').'" alt="" width="60" height="60" class="img-fluid img-80"></a>';  
                }
                  
            })
            ->addColumn('status', function($data){
                    $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->uid.'">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->uid.'">Blocked</span>';  
                    }
                })
                ->addColumn('action', function($data){
                        return '<div class="table-actions">
                        <button type="button" class="btn btn-success update-profile" data-id="'.$data->uid.'" name="'.$data->name.'" email="'.$data->email.'" password="'.$data->password.'" profile="'.$data->profile.'" phone="'.$data->phone.'" ><i class="ik ik-edit"></i>Edit Profile</button>
                        <button type="button" class="btn btn-info add-user-coin" data-id="'.$data->uid.'" ><i class="ik ik-plus"></i>Update Coin</button>
                        <a href="/user/track/'.$data->uid.'"><button type="button" data-id="'.$data->uid.'" class="btn btn-dark tr"><i class="ik ik-activity"></i>Track</button></a>
                        <a href="/users/invited-users/'.$data->refferal_id.'" target="blank"><button type="button" data-id="'.$data->uid.'" class="btn btn-dark tr"><i class="ik ik-activity"></i>Reffer History</button></a>
                        <button type="button" class="btn btn-danger remove-user" data-id="'.$data->uid.'" ><i class="ik ik-trash"></i>Delete</button>
                            </div>';
            
                })
                ->rawColumns(['DT_RowIndex','inserted_at','status','action','profile'])
                 ->toJson();

    }
    
    public function getInvitedUser($refid){
          $data  = Users::query()->where('from_refer','=',$refid)->orderBy('cust_id', 'DESC');

           return Datatables::eloquent($data)
           ->addIndexColumn()
           ->addColumn('inserted_at', function($data){
                return date('d-m-Y', strtotime($data->inserted_at));
            })
            
            ->addColumn('profile', function($data){
                if($data->profile!=null){
                    
                   if (str_contains($data->profile, 'http') == true) {
                       return '<a href="'.url($data->profile).'" target="blank"><img src="'.url($data->profile).'" alt="" width="60" height="60" class="img-fluid img-80"></a>';  
                   }else{
                       return '<a href="'.url('images/user/'.$data->profile).'" target="blank"><img src="'.url('images/user/'.$data->profile).'" alt=""  class="img-fluid img-80" width="60" height="60"></a>';  
                   }
                }else{
                    return '<a href="'.url('img/user3.jpg').'" target="blank"><img src="'.url('img/user3.jpg').'" alt="" width="60" height="60" class="img-fluid img-80"></a>';  
                }
                  
            })
            ->addColumn('status', function($data){
                    $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->uid.'">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->uid.'">Blocked</span>';  
                    }
                })
                ->addColumn('action', function($data){
                        return '<div class="table-actions">
                        <button type="button" class="btn btn-success update-profile" data-id="'.$data->uid.'" name="'.$data->name.'" email="'.$data->email.'" password="'.$data->password.'" profile="'.$data->profile.'" phone="'.$data->phone.'" ><i class="ik ik-edit"></i>Edit Profile</button>
                        <button type="button" class="btn btn-info add-user-coin" data-id="'.$data->uid.'" ><i class="ik ik-plus"></i>Update Coin</button>
                        <a href="/user/track/'.$data->uid.'"><button type="button" data-id="'.$data->uid.'" class="btn btn-dark tr"><i class="ik ik-activity"></i>Track</button></a>
                        <button type="button" class="btn btn-danger remove-user" data-id="'.$data->uid.'" ><i class="ik ik-trash"></i>Delete</button>
                            </div>';
            
                })
                ->rawColumns(['DT_RowIndex','inserted_at','status','action','profile'])
                 ->toJson();

    }
    
    function viewInvitedUser($refid){
        $total=Users::where('from_refer','=',$refid)->count();
        $user=Users::where('refferal_id',$refid)->first();
        return view('pages.invited-user',[
            'total'=>$total,
            'user'=>$user,
            'fromrefer'=> Users::where('refferal_id',$user->from_refer)->select('name','uid')->first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }
    
    function update(Request $req){
        
        if(auth()->user()->role_edit=='false'){
            return redirect('/users')->with('error',env('permission_msg'));
        }
        
        switch($req->type){
            
            case 'update_coin':
                
                    $user = Users::find($req->id);
                    $coin = $req->coin;
                    
                    if ($req->coin_type == 'debit') {
                        if ($user->balance >= $coin) {
                            $total = $user->balance - $coin;
                            $user->balance = $total;
                        }else{
                            return redirect('/users')->with('error','Not Enough Coin in Wallet to Deduct.');
                        }
                      
                    } else {
                        $total = $user->balance + $coin;
                        $user->balance = $total;
                    }
            
                    $res = $user->save();
                    if ($res) {
                        DB::table('transaction')
                            ->insert([
                                'tran_type' => $req->coin_type,
                                'user_id' => $req->id,
                                'amount' => $coin,
                                'type' => 'Coin ' . $req->type,
                                'remained_balance' => $total,
                                'inserted_at' => Carbon::now(),
                                'remarks' => $req->remark
                            ]);
                        return redirect('/users')->with('success', 'User Wallet Updated');
                    } else {
                        return redirect('/users')->with('error', 'Technical Error.');
                    }
                
                break;
                
            case 'profile':
                
                if ($req->icon) {
                    $filename =  Fun::StoreImage("images/user/", 200, 200, $req, "icon", true);
                    if ($filename == null) {
                        return redirect('/users')->with('error', 'Technical Error in Image Upload');
                    }
                } else {
                    $filename = $req->oldicon;
                }
                
                $user= Users::find($req->id);
                $user->name=$req->name;
                $user->email=$req->email;
                $user->phone=$req->phone;
                $user->profile=$filename;
                if($user->password!=$req->password){
                     Hash::make($req->password);
                }
                $res=$user->save();
                
                if($res){
                    return redirect('/users')->with('success', 'Profile Update Successfuly');
                }else{
                    return redirect('/users')->with('error', 'Technical Error');
                }
                
                break;
            
        }

    }

    
    function submit_delete_account_request(Request $req){
        
        if($req->username == null || $req->email == null ){
            return 'Please Fill All Required details';
        }
        
        if(DB::table('customer')->where('email',$req->email)->count()==0){
             return 'No Account Exist with this email.';
        }
        
        if(DB::table('account_delete_request')->where('email',$req->email)->count()==0){
             return 'Account delete request already submiited.';
        }
        
        DB::table('account_delete_request')->insert(['email'=>$req->emai,'username'=>$req->username,'remark'=>$req->remark]);
        
        return 'Account delete request submit successfully.';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
       if(auth()->user()->role_user=='false'){
            return redirect('/users')->with('error',env('permission_msg'));
        }
        
       $user = Users::find($request->id);
       $user->status=$request->status; 
       $user->reason=$request->reason; 
       $res= $user->save();
            if($res){
                return redirect('/users')->with('success','Account Status Updated !');
            }else{
                return redirect('/users')->with('error','technical Error !');
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        Users::find($id)->delete();
        return 1;
    }
}
