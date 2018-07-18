<?php
use \Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Client'],function (){
    Route::get('/','IndexController@index');
    Route::get('time','IndexController@time');
});



Route::get('login', 'Admin\LoginController@getLogin')->middleware('CheckLogout');
Route::post('login', 'Admin\LoginController@postLogin');

Route::get('logout', 'Admin\LoginController@getLogout');
Route::get('lockscreen', 'Admin\LoginController@getLockScreen');
Route::post('lockscreen', 'Admin\LoginController@postLockScreen');


Route::group(['namespace' => 'Admin'], function (){
	Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogin'], function (){
		Route::get('/', 'HomeController@getHome');
		// Route::get('/{slug}', 'HomeController@getHome');


		Route::group(['prefix' => 'account'], function(){
			Route::get('/', 'AccountController@getList');

			Route::get('add','AccountController@getAdd');
			Route::post('add','AccountController@postAdd');

			Route::get('edit/{id}','AccountController@getEdit');
			Route::post('edit/{id}','AccountController@postEdit');

			Route::get('delete/{id}','AccountController@getDelete');

		});

		Route::group(['prefix' => 'profile'], function(){
			Route::get('/', 'ProfileController@getDetail');
			Route::post('/', 'ProfileController@postDetail');

			Route::get('change_pass', 'ProfileController@getChangePass');
			Route::post('change_pass', 'ProfileController@postChangePass');

		});

		Route::group(['prefix' => 'advert'], function(){
			Route::get('/', 'AdvertController@index');

			Route::get('add','AdvertController@create');
			Route::post('add','AdvertController@store');

			Route::get('edit/{id}','AdvertController@edit');
			Route::post('edit/{id}','AdvertController@update');

			Route::get('delete/{id}','AdvertController@destroy');

			Route::get('top', 'AdvertController@getTop');
			Route::get('top/{id}', 'AdvertController@getGroup');
			Route::get('top_add/{id}/{ad_id}', 'AdvertController@addTopAdvert');
			Route::get('top_delete/{id}', 'AdvertController@deleteTopAdvert');
		});


	});
});
