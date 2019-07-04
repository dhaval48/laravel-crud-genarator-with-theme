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

Route::get('/', function () {
    return view('comingsoon::comingsoon');
});

Auth::routes();

Route::get('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@users')->name('users');
Route::get('/user/create', 'HomeController@userCreate')->name('user_create');

Route::group(['namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['auth']], function () {

        require (__DIR__ . '/Common.php');
    });
});

Route::group(['namespace' => 'Backend', 'prefix' => 'general'], function () {
	Route::group(['middleware' => ['auth']], function () {
		Route::get('themesettings', 'ThemesettingController@edit')->name('themesetting.index');		
		Route::post('themesetting/store', 'ThemesettingController@store')->name('themesetting.store');
	});
});

Route::group(['namespace' => 'Backend'], function () {
	Route::group(['middleware' => ['auth']], function () {
		Route::get('settings', 'SettingController@edit')->name('setting.index');		
		Route::post('setting/store', 'SettingController@store')->name('setting.store');
	});
});
// [RouteArray]