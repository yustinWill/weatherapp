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

//Routes without session checking
Route::get('/', 'FrontEnd\HomePageController@index')->name('home_page');
Route::post('/subscribe', 'FrontEnd\HomePageController@subscribe')->name('home_page_subscribe');

Route::get('/admin', 'Authentication\LoginController@index')->name('login_view');
Route::post('/authentication/login', 'Authentication\LoginController@process')->name('login_process');
Route::get('/authentication/logout', 'Authentication\LogoutController@index')->name('logout_process');
// SEND EMAIL FORGOT PASSWORD
Route::post('/authentication/forgotPassword', 'Authentication\ForgotPasswordController@send_email')->name('forgot_password');
// FORM FOR FORGOT PASSWORD (WEB VIEW)
Route::get('/authentication/forgotPasswordView', 'Authentication\ForgotPasswordController@forgot_password_view')->name('forgot_password_view');
Route::post('/authentication/forgotPasswordView', 'Authentication\ForgotPasswordController@forgot_password_save')->name('forgot_password_save');

//Routes with session checking
Route::group(['middleware' => 'check_user_session'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Weather Log
    Route::get('/weather_log/view', 'WeatherLog\ViewController@index')->name('weather_log_view');
    Route::get('/weather_log/detail', 'WeatherLog\ViewController@detail')->name('weather_log_view_detail');
    Route::post('/weather_log/generate_full', 'WeatherLog\ViewController@generate_full_log')->name('weather_log_generate_full');
    Route::get('/weather_log/add', 'WeatherLog\AddController@index')->name('weather_log_add');
    Route::post('/weather_log/save', 'WeatherLog\AddController@save')->name('weather_log_save');
    Route::post('/weather_log/delete', 'WeatherLog\DeleteController@index')->name('weather_log_delete');

    //Master User
    Route::get('/master_user/view', 'MasterUser\ViewController@index')->name('master_user_view');
    Route::get('/master_user/detail', 'MasterUser\ViewController@detail')->name('master_user_view_detail');
    Route::get('/master_user/add', 'MasterUser\AddController@index')->name('master_user_add');
    Route::get('/master_user/edit', 'MasterUser\EditController@index')->name('master_user_edit');
    Route::post('/master_user/save', 'MasterUser\AddController@save')->name('master_user_save');
    Route::post('/master_user/update', 'MasterUser\EditController@update')->name('master_user_update');
    Route::post('/master_user/delete', 'MasterUser\DeleteController@index')->name('master_user_delete');

    //Master Admin
    Route::get('/master_admin/view', 'MasterAdmin\ViewController@index')->name('master_admin_view');
    Route::get('/master_admin/detail', 'MasterAdmin\ViewController@detail')->name('master_admin_view_detail');
    Route::get('/master_admin/add', 'MasterAdmin\AddController@index')->name('master_admin_add');
    Route::get('/master_admin/edit', 'MasterAdmin\EditController@index')->name('master_admin_edit');
    Route::post('/master_admin/save', 'MasterAdmin\AddController@save')->name('master_admin_save');
    Route::post('/master_admin/update', 'MasterAdmin\EditController@update')->name('master_admin_update');
    Route::post('/master_admin/delete', 'MasterAdmin\DeleteController@index')->name('master_admin_delete');
    
    //Master Location
    Route::get('/master_location/view', 'MasterLocation\ViewController@index')->name('master_location_view');
    Route::get('/master_location/detail', 'MasterLocation\ViewController@detail')->name('master_location_view_detail');
    Route::get('/master_location/add', 'MasterLocation\AddController@index')->name('master_location_add');
    Route::get('/master_location/edit', 'MasterLocation\EditController@index')->name('master_location_edit');
    Route::post('/master_location/save', 'MasterLocation\AddController@save')->name('master_location_save');
    Route::post('/master_location/update', 'MasterLocation\EditController@update')->name('master_location_update');
    
    //Weather Config
    Route::get('/weather_config/view', 'WeatherConfig\ViewController@index')->name('weather_config_view');
    Route::get('/weather_config/detail', 'WeatherConfig\ViewController@detail')->name('weather_config_view_detail');
    Route::get('/weather_config/add', 'WeatherConfig\AddController@index')->name('weather_config_add');
    Route::post('/weather_config/save', 'WeatherConfig\AddController@save')->name('weather_config_save');
});
