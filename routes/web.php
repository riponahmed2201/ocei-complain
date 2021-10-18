<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
// Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/complainer-login', 'Auth\AdminLoginController@showLoginForm')->name('complainer.login');
Route::post('/complainer_login_check', 'Auth\AdminLoginController@complainer_login_check')->name('complainer.login_check');
Route::post('/complainer_logout', 'Auth\AdminLoginController@logout')->name('complainer.logout');

Route::middleware('admin')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
	////*************all complainer************
    Route::get('/all-complain','Backend\ComplainController@allComplain')->name('all-complain');
    //Complain Delete & Forword
    Route::post('/delete/all/complain','Backend\ComplainController@deleteAll');
    Route::post('/forward/all/complain','Backend\ComplainController@forwordAll');
    ///*********employee***************//
    Route::get('/all-forward-complain','Backend\EmployeeController@forwardingComplain')->name('forward-complain');
});


/////**********************frontend**********************************
Route::get('/','Frontend\HomeController@index')->name('home');
///*********************registration*******************
//Route::get('/registration','Frontend\RegistrationController@register')->name('register');
//Route::post('/register','Frontend\RegistrationController@storeRegister')->name('store.register');

///***************Complain*******************
Route::get('/complain', 'Frontend\ComplainController@showComplainForm')->name('complain-form');
Route::post('/complain-form','Frontend\ComplainController@storeComplain')->name('store.complain');

