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
    Route::get('/{slug}','IndexController@getGroup');
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

		Route::get('/group','GroupController@getList')->name('admin_group');
		Route::get('/group/form_group/{id}',['as' => 'form_group','uses' => 'GroupController@form_group']);
		Route::post('/action_group',['as' => 'action_group','uses' => 'GroupController@action_group']);
		Route::get('/delete_group/{id}',['as' => 'delete_group','uses' => 'GroupController@delete_group']);

        /*
         * articel
         */

        Route::group(['prefix' => 'articel'], function(){
            Route::get('/','ArticelController@get_list')->name('admin_articel');
            Route::get('/form_articel/{id}','ArticelController@form_articel')->name('form_articel');
            Route::post('/action_articel','ArticelController@action_articel')->name('action_articel');
            Route::get('/delete_articel/{id}','ArticelController@delete_articel')->name('delete_articel');
        });

        Route::group(['prefix' => 'video'], function(){
            Route::get('/','VideoController@get_list')->name('admin_video');
            Route::get('/form_video/{id}','VideoController@form_video')->name('form_video');
            Route::post('/action_video','VideoController@action_video')->name('action_video');
            Route::get('/delete_video/{id}','VideoController@delete_video')->name('delete_video');
            Route::get('/history_video/{id}','VideoController@history_video')->name('history_video');
            Route::get('/update_status/{id}','VideoController@update_status')->name('update_status');
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

Route::post('/upload_image',['as' => 'upload_image','uses' => 'ClientController@upload_image']);
