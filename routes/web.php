<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

// Route::get('testing', function(){return response()->json('working fine new route');});
// dashboard route  
Route::get('/dashboard','AdminController@index')->name('dashboard');

Route::get('/', 'HomeController@defaultHome');
Route::get('/delete-account', function(){ return view('pages.delete-account'); });
Route::post('submit-delete-account-request', 'CustomerController@submit_delete_account_request');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/verify/auth/{token}/{enc}', 'Api\UserController@verifyEmail');

Route::get('/test', 'SocialController@test');
Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/clear-cache', 'HomeController@clearCache');
	Route::get('/call', 'HomeController@call');
	Route::get('/users', 'CustomerController@index');
	Route::get('/users/delete/{id}', 'CustomerController@destroy');
	Route::get('/users/banned', 'CustomerController@bannedindex');
	Route::post('/users/status', 'CustomerController@status');
	Route::get('/user/get-list/{status}', 'CustomerController@getUserList');
	Route::get('/user-transaction', 'TransactionController@index');
	Route::get('/user/track/{id}', 'TransactionController@usertrack');
	Route::get('/users/invited-users/{refid}','CustomerController@viewInvitedUser');
	Route::get('/users/invited/{refid}', 'CustomerController@getInvitedUser');
	Route::post('/users/update', 'CustomerController@update');
	
	
	Route::get('/transaction/data', 'TransactionController@getTransacitonList');
	Route::get('/transaction/{id}', 'TransactionController@getUserTransaciton');
	Route::get('/setting-general','SettingController@index');
	Route::post('/setting/update', 'SettingController@update');
	Route::get('/setting/ads', 'SettingController@ads');
	Route::get('/setting/spin', 'SettingController@spin');
	Route::get('/setting/app', 'SettingController@app');
	Route::post('/setting/app-setting', 'SettingController@appupdate');
	Route::post('/setting/spinupdate', 'SettingController@spinupdate');
	Route::view('/notification', 'notification');
	Route::post('/notification/send', 'NotificationController@new');
	Route::get('/admin-profile', 'AdminController@admin');
	Route::post('/admin/update', 'AdminController@update');
	Route::post('/verify', 'AdminController@verify');

	//web
	Route::get('/websites', 'WeblinkController@index');
	Route::get('/websites/list', 'WeblinkController@List');
	Route::get('/websites/create-websites', function () { return view('web.create-web'); });
	Route::post('/websites/create', 'WeblinkController@store');
	Route::get('/websites/edit/{id}', 'WeblinkController@edit');
	Route::post('/websites/update', 'WeblinkController@update');
	Route::get('/websites/delete/{id}', 'WeblinkController@destroy');
	
	
	//hot offer
	Route::get('/hotoffer', 'HotOfferController@index');
	Route::get('/hotoffer/list', 'HotOfferController@List');
	Route::get('/hotoffer/create', function () { return view('hotoffer.create'); });
	Route::get('/hotoffer/approval', function () { return view('hotoffer.pending'); });
	Route::get('/hotoffer/approved', function () { return view('hotoffer.complete'); });
	
	Route::get('/hotoffer/list/pending', 'HotOfferController@ListPending');
	Route::get('/hotoffer/list/approved',  'HotOfferController@ListApproved');
	
	Route::get('/hotoffer/offer/approval/{id}',  'HotOfferController@ApproveOffer');
	Route::post('/hotoffer/offer/reject',  'HotOfferController@RejectOffer');
	
	
	Route::post('/hotoffer/create', 'HotOfferController@store');
	Route::get('/hotoffer/edit/{id}', 'HotOfferController@edit');
	Route::post('/hotoffer/update', 'HotOfferController@update');
	Route::get('/hotoffer/delete/{id}', 'HotOfferController@destroy');
	
	
	//video
	Route::get('/videos', 'VideoController@index');
	Route::get('/videos/list', 'VideoController@List');
	Route::get('/videos/create-video', function () { return view('video.create-video'); });
	Route::post('/videos/create', 'VideoController@store');
	Route::get('/videos/edit/{id}', 'VideoController@edit');
	Route::post('/videos/update', 'VideoController@update');
	Route::get('/videos/delete/{id}', 'VideoController@destroy');
	
	//apps
	Route::get('/apps', 'AppsController@index');
	Route::get('/apps/list', 'AppsController@List');
	Route::get('/apps/create-app', function () { return view('app.create-app'); });
	Route::post('/apps/create', 'AppsController@store');
	Route::get('/apps/edit/{id}', 'AppsController@edit');
	Route::post('/apps/update', 'AppsController@update');
	Route::get('/apps/delete/{id}', 'AppsController@destroy');

	//rewards
	Route::get('/payment-options', 'RedeemController@index');
	Route::get('/payment-options/list', 'RedeemController@List');
	Route::get('/payment-options/create', function () { return view('redeem.create-redeem'); });
	Route::post('/payment-options/create', 'RedeemController@store');
	Route::get('/payment-options/edit/{id}', 'RedeemController@edit');
	Route::post('/payment-options/update', 'RedeemController@update');
	Route::get('/payment-options/delete/{id}', 'RedeemController@destroy');
	
	//offerwall
	Route::get('/offerwall', 'OfferwallController@index');
	Route::get('/offerwall/list', 'OfferwallController@List');
	Route::get('/offerwall/create', function () { return view('offerwall.create'); });
	Route::post('/offerwall/create', 'OfferwallController@store');
	Route::get('/offerwall/edit/{id}', 'OfferwallController@edit');
	Route::post('/offerwall/update', 'OfferwallController@update');
	Route::get('/offerwall/delete/{id}', 'OfferwallController@destroy');
	Route::post('/offerwall/action', 'OfferwallController@action');
	
	// home offer
	Route::get('/offer', 'OfferController@index');
	Route::get('/offer/list', 'OfferController@list');
	Route::get('/offer/edit/{id}', 'OfferController@edit');
	Route::post('/offer/update', 'OfferController@update');
	Route::post('/offer/action', 'OfferController@action');

	//banner
	Route::get('/banner', 'BannerController@index');
	Route::get('/banner/list', 'BannerController@List');
	Route::post('/banner/create', 'BannerController@store');
	Route::post('/banner/action', 'BannerController@action');
	Route::get('/banner/edit/{id}', 'BannerController@edit');
	Route::post('/banner/update', 'BannerController@update');
	Route::get('/banner/delete/{id}', 'BannerController@destroy');
	
	//language
	Route::get('/language', 'LangController@index');
	Route::get('/language/list', 'LangController@List');
	Route::post('/languagelanguage/create', 'LangController@store');
	Route::get('/language/edit/{id}', 'LangController@edit');
	Route::post('/language/update', 'LangController@update');
	
		//language-data
	Route::get('/language/data', 'LangController@indexData');
	Route::post('/language/update-lang-txt', 'LangController@updateLangText');

	
	//social links
	Route::get('/social-link', 'SocialController@index');
	Route::get('/social-link/list', 'SocialController@List');
	Route::post('/social-link/create', 'SocialController@store');
	Route::post('/social-link/action', 'SocialController@action');
	Route::post('/social-link/update', 'SocialController@update');
	Route::get('/social-link/edit/{id}', 'SocialController@edit');
	Route::get('/social-link/delete/{id}', 'SocialController@destroy');
  
  //manage admins
	Route::get('/admins', 'AdminController@indexAdmin');
	Route::get('/admins/list', 'AdminController@List');
	Route::post('/admins/create', 'AdminController@store');
	Route::post('/admins/action', 'AdminController@action');
	Route::get('/admins/edit/{id}', 'AdminController@edit');
	Route::post('/admins/update', 'AdminController@updateAdmin');
	Route::get('/admins/delete/{id}', 'AdminController@destroy');
	
	//games
	Route::get('/games', 'GameController@index');
	Route::get('/games/list', 'GameController@List');
	Route::post('/games/create', 'GameController@store');
	Route::post('/games/action', 'GameController@action');
	Route::get('/games/edit/{id}', 'GameController@edit');
	Route::post('/games/update', 'GameController@update');
	Route::get('/games/delete/{id}', 'GameController@destroy');
	
	//request pending
	Route::get('/request/completelist', 'PaymentController@completelist'); // this one
	Route::get('/request-pending', 'PaymentController@index');
	Route::get('/request/pendinglist', 'PaymentController@pendinglist');
	//request reject
	Route::get('/request-reject', 'PaymentController@viewreject');
	Route::get('/request/rejectlist', 'PaymentController@rejectlist');
	
	Route::post('/request/update', 'PaymentController@update');
	Route::get('/request/delete/{id}', 'PaymentController@destroy');
	Route::get('/request/{id}', 'PaymentController@list');

	//request complete
	Route::get('/request-complete', 'PaymentController@viewcomplete');



	
});



