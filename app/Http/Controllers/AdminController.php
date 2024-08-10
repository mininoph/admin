<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Users;
use App\Models\Video;
use App\Models\Weblink;
use App\Models\Redeem;
use App\Models\Apps;
use DataTables, Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    // index admin 
    public function indexAdmin()
    {
        return view('pages.admin-users');
    }

    public function List()
    {
        $data = User::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($data) {
                return date('d-m-Y', strtotime($data->created_at));;
            })
            ->addColumn('action', function ($data) {
              if($data->id>2){
                  return '<div class="table-actions">
                   <button type="button" class="btn btn-success edit-admin" data-id="' . $data->id . '"  ><i class="ik ik-edit"></i>Edit</button>
                  <button type="button" class="btn btn-danger remove-admin" data-id="' . $data->id . '"  ><i class="ik ik-trash"></i>Delete</button>
                </div>';
              }else{
                return '';
              }
            })
            ->rawColumns(['DT_RowIndex', 'created_at', 'action'])
            ->make(true);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|between:4,15|regex:/^[\w ]+$/|unique:employees',
            'email' => 'required|string|email|max:40|unique:employees',
            'password' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return redirect('/admins')->with('error', $validator->errors()->first());
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role_edit = $req->role_edit;
        $user->role_create = $req->role_create;
        $user->role_delete = $req->role_delete;
        $user->role_user = $req->role_user;
        $user->role_setting = $req->role_setting;
        $res = $user->save();

        if ($res) {
            return redirect('/admins')->with('success', 'Admin Created Successfully');
        } else {
            return redirect('/admins')->with('error', 'Something went wrong!');
        }
    }

	public function edit(User $id){
        return $id; 
    }
    
    public function updateAdmin(Request $req)
    {
        
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role_edit = $req->role_edit;
        $user->role_create = $req->role_create;
        $user->role_delete = $req->role_delete;
        $user->role_user = $req->role_user;
        $user->role_setting = $req->role_setting;
        if($req->password){
            $user->password = Hash::make($req->password);  
        }
        $res = $user->save();

        if ($res) {
            return redirect('/admins')->with('success', 'Admin Update Successfully');
        } else {
            return redirect('/admins')->with('error', 'Something went wrong!');
        }
    }

    public function index()
    {
        $offer=DB::select("SELECT SUM(earning) as income FROM offerwall_earing");

        $now = Carbon::now();
        $user =  Users::count();
        $apps =  Apps::count();
        $redeem =  Redeem::count();
        $video =  Video::count();
        $weblink =  Weblink::count();
        $pending = DB::table('recharge_request')->where('status', 'Pending')->count();
        $transaction = DB::table('transaction')->count();
        $complete = DB::table('recharge_request')->where('status', 'Success')->count();
        $today = DB::table('personal_access_tokens')->wheredate('created_at', $now)->count();
        $week = DB::table('personal_access_tokens')->where('created_at', '>', Carbon::now()->startOfWeek())->where('created_at', '<', Carbon::now()->endOfWeek())->count();
        $month = DB::table('personal_access_tokens')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get(['name', 'created_at'])
            ->count();
            
         $allusercount = Users::select('uid','inserted_at')
            ->get()
            ->groupBy(function ($datess) {
                if(Carbon::parse($datess->inserted_at)->format('Y')==Carbon::now()->year){
                                return Carbon::parse($datess->inserted_at)->format('m');
                }
            });

            $usermcountss = [];
            $userArrss = [];
        
            foreach ($allusercount as $key => $value) {
                $usermcountss[(int)$key] = count($value);
            }
        
            $monthss = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
            for ($i = 1; $i <= 12; $i++) {
                if (!empty($usermcountss[$i])) {
                    $userArrss[$i]['count'] = $usermcountss[$i];
                } else {
                    $userArrss[$i]['count'] = 0;
                }
                $userArrss[$i]['month'] = $monthss[$i - 1];
            }           
            
        return view(
            'pages.dashboard',
            [
                'user' => $user,
                'apps' => $apps,
                'redeem' => $redeem,
                'video' => $video,
                'weblink' => $weblink,
                'pending' => $pending,
                'transaction' => $transaction,
                'today' => $today,
                'week' => $week,
                'month' => $month,
                'complete' => $complete,
                'alluser'=>$userArrss,
                'offerwall_income' => $offer
            ]
        );
    }


    public function admin()
    {
        $adminSetting=DB::table('admin_setting')->where('id',1)->get();
        
        if ($adminSetting[0]->api_key == null || $adminSetting[0]->offer_secret_key == null) {
            $apikey=null;
            $offerkey=null;
            ($adminSetting[0]->api_key == null) ? $apikey=Str::random(30) : $apikey=$adminSetting[0]->api_key;
            ($adminSetting[0]->offer_secret_key == null) ? $offerkey=Str::random(15) : $offerkey=$adminSetting[0]->offer_secret_key;
        
            DB::table('admin_setting')->where('id',1)->update(['api_key'=>$apikey,'offer_secret_key'=>$offerkey]);
 
            $adminSetting=DB::table('admin_setting')->where('id',1)->get();
       }
        

        $data = User::find(Auth::id());
        return view('pages.admin', ['data' => $data,'adminsetting'=>$adminSetting]);
    }

    public static function updateData($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key),
                $key . '=' . $value,
                file_get_contents($path)
            ));
        }

        // \Artisan::call('config:cache');
        \Artisan::call('config:clear');
    }


    public function update(Request $req)
    {
        if ($req->type == "server") {
            $this->updateData('API_URL', $req->API_URL);
            return redirect('/admin-profile')->with('success', 'Update Successfully !!');
        } else {
            $user = User::find(Auth::id());

            if (!$user || !Hash::check($req->oldpass, $user->password)) {
                return redirect('/admin-profile')->with('error', 'Old Password Not Matched !!');
            } else {
                if ($req->newpas == $req->cnpas) {
                    $admin = User::find(Auth::id());
                    $admin->email = $req->email;
                    $admin->password = Hash::make($req->newpas);
                    $res = $admin->save();
                    if ($res) {
                        return redirect('/admin-profile')->with('success', 'Update Successfully !!');
                    } else {
                        return redirect('/admin-profile')->with('error', 'Error While Update Data !!');
                    }
                } else {
                    return redirect('/admin-profile')->with('error', 'New Password and Confirm Password Not Matched !!');
                }
            }
        }
    }
 
    public function destroy($id){
        User::where('id',$id)->delete();
        return 1;
    }
}
