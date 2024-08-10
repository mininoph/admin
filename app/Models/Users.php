<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{ 
    use HasApiTokens,HasFactory,Notifiable;


    public $table='customer';
    protected $primaryKey='uid';
    public $keyType = 'string';
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name','phone','email','refferal_id','password','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','inserted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function getAuthPassword(){
        return $this->password; // myPasswordField is the field on your users table for password
    }
    // public function get_roles(){
    //     $roles = [];
    //     foreach ($this->getRoleNames() as $key => $role) {
    //         $roles[$key] = $role;
    //     }

    //     return $roles;
    // }
    
    public static function getUserNameById($id){
            $u= Users::where('uid', $id)->pluck('name')->first();
        if($u){
            return $u;
        }else{
          return Users::where('cust_id', $id)->pluck('name')->first();
        }
    }
    
}

