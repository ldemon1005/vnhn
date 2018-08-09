<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertController extends Controller
{
    public function getAdvert(){
    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.advert', $data);
    }
    public function getContact(){
    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.contact', $data);
    }
    public function getOrder(){
    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.order', $data);
    }

}
