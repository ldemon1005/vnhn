<?php

namespace App\Http\Controllers\Client;

use App\Models\AdvertContact;
use App\Models\AdvertOrder;
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
    public function postContact(Request $request){
    	$data = new AdvertContact;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	// $data->city = $request->city;
    	$data->city = "Hà nội";
    	$data->company = $request->company;
    	$data->type = $request->type;
    	$data->content = $request->content;
    	$data->save();
    	return back()->with('success', 'Gửi thành công');
    }
    public function postOrder(Request $request){
    	$data = new AdvertOrder;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	$data->address = $request->address_1.'|'.$request->address_2.'|'.$request->address_3;
    	$data->no = $request->no;
    	$data->amount = $request->amount;
    	$data->content = $request->content;
    	$data->save();
    	return back()->with('success', 'Gửi thành công');
    }


}
