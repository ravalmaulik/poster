<?php

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

Route::get('/admin', function () {
    if (Auth::guard('admin')->check()) {
		return redirect('admin/dashboard');
	}else{
	    return view('super_Admin/login/login');
	}
});
Route::post('/adminlogin', "AdminController@authenticat_user")->name('admin.login');


Route::group(['middleware' => ['AdminAuth']], function(){
	Route::any('/adminlogout',function (){
		Auth::guard('admin')->logout();
		return redirect('/admin');
	})->name('admin.logout');

    Route::get('admin/dashboard',array('as' => 'admin.dashboard','uses'=>'AdminDashboardController@index'));

    Route::any('admin/client',array('as' => 'client','uses'=>'ClientController@index'));
    Route::any('admin/client/datatable',array('as' => 'client.datatable','uses'=>'ClientController@datatable'));
    Route::any('admin/client/add',array('as' => 'client.add','uses'=>'ClientController@add'));
    Route::any('admin/client/delete',array('as' => 'client.delete','uses'=>'ClientController@delete'));
    Route::any('admin/client/get',array('as' => 'client.get','uses'=>'ClientController@get'));
    Route::any('admin/client/update',array('as' => 'client.update','uses'=>'ClientController@update'));
    Route::get('admin/client/client_access',array('as' => 'client.client_access','uses'=>'ClientController@client_access'));
});

// ------------------------------------------Client rout------------------------------------------------------------------

Route::get('/',function ()
{
	if (Auth::guard('client')->check()) {
		return redirect('/dashboard');
	}else{
	    return view('client/login/login');
	}
});
Route::post('/clientlogin', "ClientController@authenticat_user")->name('client.login');

Route::group(['middleware' => ['ClientAuth']], function(){
	Route::any('/clientlogout',function (){
		Auth::guard('client')->logout();
		return redirect('/');
	})->name('client.logout');

    Route::get('/dashboard',array('as' => 'client.dashboard','uses'=>'ClientDashboardController@index'));

    Route::get('/post',array('as' => 'post','uses'=>'ClientDashboardController@index'));
    Route::get('/post/category',array('as' => 'post.category','uses'=>'ClientDashboardController@index'));

    Route::get('/event',array('as' => 'event','uses'=>'ClientDashboardController@index'));
    Route::get('event/category',array('as' => 'event.category','uses'=>'ClientDashboardController@index'));

    Route::get('/biography',array('as' => 'biography','uses'=>'ClientDashboardController@index'));
    Route::get('biography/category',array('as' => 'biography.category','uses'=>'ClientDashboardController@index'));

    Route::get('/achievement',array('as' => 'achievement','uses'=>'ClientDashboardController@index'));
    Route::get('achievement/category',array('as' => 'achievement.category','uses'=>'ClientDashboardController@index'));

    Route::get('/gallery',array('as' => 'gallery','uses'=>'ClientDashboardController@index'));
    Route::get('/idols',array('as' => 'idols','uses'=>'ClientDashboardController@index'));
    Route::get('/connect',array('as' => 'connect','uses'=>'ClientDashboardController@index'));
    Route::get('/appsetting',array('as' => 'appsetting','uses'=>'ClientDashboardController@index'));
    Route::get('/member',array('as' => 'member','uses'=>'ClientDashboardController@index'));
    Route::get('/appsetting',array('as' => 'appsetting','uses'=>'ClientDashboardController@index'));
    Route::get('/appsetting',array('as' => 'appsetting','uses'=>'ClientDashboardController@index'));
    Route::get('/appsetting',array('as' => 'appsetting','uses'=>'ClientDashboardController@index'));
    

    // Route::get('/biography',array('as' => 'biography','uses'=>'ClientDashboardController@index'));
    // Route::get('biography/category',array('as' => 'biography.category','uses'=>'ClientDashboardController@index'));
});