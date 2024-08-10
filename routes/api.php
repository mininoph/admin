<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    
    Route::get('sldiebanner', 'Api\Func@sldiebanner');
    Route::post('datas', 'Api\Func@initCr');
    Route::get('redeem', 'Api\Func@fetch_rewards');
    Route::get('games', 'Api\Func@games'); // old
    Route::get('leaderboard', 'Api\Func@leaderboard'); // old
    Route::get('offers', 'Api\Func@offers');
    Route::get('hotoffer/{id}', 'Api\Func@get_hotoffer');
    
    
    Route::get('offerwall', 'Api\Func@get_offerwall');
    Route::get('get_refer_list/{refid}', 'Api\Func@get_refer_list');
    Route::get('social-links', 'Api\Func@get_social_link');
    
    Route::post('update-profile-pass', 'Api\UserController@update_profile_pass');
    Route::post('update-profile', 'Api\UserController@update_profile');
    
    
    Route::post('submit_hotoffer', 'Api\Func@submit_hotoffer');
    
    Route::get('global_msg/{id}', 'Api\Func@get_global_msg');
    Route::get('global_msg/status/{id}', 'Api\Func@global_msg_update');
    
    
    });
    
 //   Route::get('offerwall_init', 'Api\OfferController@offerwall_credit');
    Route::get('/offer_cr/{id}','Api\OfferController@offerwall_credit');
    Route::get('/offer_cpxcr','Api\OfferController@offer_cpxcr');

        
    Route::get('abouts', 'Api\Func@abouts');
    Route::get('get_lang_data/{lang}', 'Api\Func@get_lang_data');
    Route::get('get_lang', 'Api\Func@get_lang');

    Route::post('reset-password', 'Api\UserController@reset');
    Route::post('verify-otp', 'Api\UserController@verify');
    Route::post('update_password', 'Api\UserController@update_password');
    Route::post('user', 'Api\UserController@index');
    Route::get('send_Verfiyotp/{email}', 'Api\UserController@send_Verfiyotp');

    
    
    