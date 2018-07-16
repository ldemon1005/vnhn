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

Route::group(['namespace' => 'Admin'], function (){
	Route::group(['prefix' => 'admin'], function (){
		Route::get('/', 'HomeController@getHome');
		Route::get('/group','GroupController@getList')->name('admin_group');
		Route::get('/group/form_group/{id}',['as' => 'form_group','uses' => 'GroupController@form_group']);
		Route::post('/action_group',['as' => 'action_group','uses' => 'GroupController@action_group']);
		Route::get('/delete_group/{id}',['as' => 'delete_group','uses' => 'GroupController@delete_group']);

        /*
         * articel
         */
        Route::get('/articel','ArticelController@get_list')->name('admin_articel');
        Route::get('/articel/form_articel/{id}','ArticelController@form_articel')->name('form_articel');
	});
});

Route::post('/upload_image',['as' => 'upload_image','uses' => 'ClientController@upload_image']);
