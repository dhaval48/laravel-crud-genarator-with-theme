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
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@users')->name('users');
Route::get('/user/create', 'HomeController@userCreate')->name('user_create');

Route::group(['namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['auth', 'locale:en']], function () {

        require (__DIR__ . '/Common.php');
    });
});

Route::group(['namespace' => 'Backend', 'prefix' => 'general'], function () {
	Route::group(['middleware' => ['auth', 'locale:en']], function () {
		Route::get('statuss', 'StatusController@index')->name('status.index');
		Route::get('statuss-paginate','StatusController@Paginate')->name('status.paginate');
		Route::get('status/create', 'StatusController@create')->name('status.create');
		Route::post('status/store', 'StatusController@store')->name('status.store');
		Route::get('status/edit/{id}', 'StatusController@edit')->name('status.edit');
		Route::post('status/destroy', 'StatusController@destroy')->name('status.destroy');
	});
});

Route::group(['namespace' => 'Backend', 'prefix' => 'general'], function () {
	Route::group(['middleware' => ['auth', 'locale:en']], function () {
		Route::get('themesettings', 'ThemesettingController@edit')->name('themesetting.index');
		// Route::get('themesettings-paginate','ThemesettingController@Paginate')->name('themesetting.paginate');
		// Route::get('themesetting/create', 'ThemesettingController@create')->name('themesetting.create');
		Route::post('themesetting/store', 'ThemesettingController@store')->name('themesetting.store');
		// Route::get('themesetting/edit/{id}', 'ThemesettingController@edit')->name('themesetting.edit');
		// Route::post('themesetting/destroy', 'ThemesettingController@destroy')->name('themesetting.destroy');
	});
});
// [RouteArray]