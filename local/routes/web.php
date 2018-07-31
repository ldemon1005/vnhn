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
//Route::group(['middleware' => 'Start'],function(){
//
//});

Route::group(['namespace' => 'Client','middleware' => 'Start'],function (){
    Route::get('/','IndexController@index')->name('home');
    Route::group(['prefix'=>'articel'],function(){
        Route::get('/{slug}','ArticelController@get_detail')->name('get_detail_articel');
        Route::post('action_comment','ArticelController@action_comment')->name('action_comment');
    });

    Route::group(['prefix' => 'group'],function(){
        Route::get('/{slug}','GroupController@get_articel_by_group')->name('get_articel_by_group');
    });
    Route::get('/open_video/{id}','VideosController@open_video')->name('open_video');
});


Route::get('/vnhn_start','ClientController@vnhn_start')->name('vnhn_start');

Route::get('/set_lang/{lang}','ClientController@set_lang')->name('set_lang');

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
		Route::get('/group/form_sort_group/{id}',['as' => 'form_sort_group','uses' => 'GroupController@form_sort_group']);
		Route::post('/group/update_order',['as' => 'update_order','uses' => 'GroupController@update_order']);

        /*
         * articel
         */

        Route::group(['prefix' => 'articel'], function(){
            Route::get('/','ArticelController@get_list')->name('admin_articel');
            Route::get('/form_articel/{id}','ArticelController@form_articel')->name('form_articel');
            Route::post('/action_articel','ArticelController@action_articel')->name('action_articel');
            Route::get('/delete_articel/{id}','ArticelController@delete_articel')->name('delete_articel');
            Route::get('/history_articel/{id}','ArticelController@history_articel')->name('history_articel');
            Route::get('/view_log/{id}','ArticelController@view_log')->name('view_log');
            Route::get('/sort_hot_articel','ArticelController@sort_hot_articel')->name('sort_hot_articel');
            Route::post('/sort_hot_articel_post','ArticelController@sort_hot_articel_post')->name('sort_hot_articel_post');
            Route::post('/update_order_articel','ArticelController@update_order_articel')->name('update_order_articel');
            Route::get('/delete_articel_hot/{groupid}/{id}','ArticelController@delete_articel_hot')->name('delete_articel_hot');
            Route::get('/update_status/{id}','ArticelController@update_status')->name('update_status');
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
			Route::get('top/{id}/{lo_id}', 'AdvertController@getGroup');
			Route::get('top_add/{id}/{lo_id}/{ad_id}', 'AdvertController@addTopAdvert');
			Route::get('top_delete/{id}', 'AdvertController@deleteTopAdvert');

            Route::post('on', 'AdvertController@getOn');
            Route::post('off', 'AdvertController@getOff');
		});

		Route::group(['prefix' => 'website_info'],function(){
		    Route::get('/','WebsiteInfoController@index')->name('website_info');
            Route::post('/add_info','WebsiteInfoController@add_info')->name('add_info');
            Route::post('/update_info','WebsiteInfoController@update_info')->name('update_info');
            Route::get('/delete_info/{id}','WebsiteInfoController@delete_info')->name('delete_info');
        });

        Route::group(['prefix' => 'magazine'], function(){
            Route::get('/','MagazineController@index')->name('admin_magazine');
            Route::get('/form_magazine/{id}','MagazineController@form_magazine')->name('form_magazine');
            Route::post('/action_magazine','MagazineController@action_magazine')->name('action_magazine');
            Route::get('/delete_magazine/{id}','MagazineController@delete_magazine')->name('delete_magazine');
        });


        Route::group(['prefix'=>'comment'],function(){
            Route::get('/','CommentController@index')->name('admin_comment');
            Route::get('/update_comment/{id}','CommentController@update_status')->name('update_comment');
        });
	});
});

Route::post('/upload_image',['as' => 'upload_image','uses' => 'ClientController@upload_image']);

Route::get('{slug}', 'Client\IndexController@home');
