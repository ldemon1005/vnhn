<?php

namespace App\Http\Controllers\Client;

use App\Models\AdvertContact;
use App\Models\AdvertOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdvertController extends Controller
{
    public function getAdvert(){
        $data['list_city'] = $this->get_cities();

    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.advert', $data);
    }
    public function getContact(){
        $data['list_city'] = $this->get_cities();

    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.contact', $data);
    }
    public function getOrder(){
        $data['list_city'] = $this->get_cities();

    	$data['list_ad'] = app('App\Http\Controllers\Client\IndexController')->get_advert(1);

        $data['ad_home'] = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
    	return view('client.advert.order', $data);
    }
    public function postContact(Request $request){
    	$data = new AdvertContact;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
        $request->city != null ? $data->city = $request->city : $data->city = "Không có";
    	$data->company = $request->company;
    	$data->type = $request->type;
        $request->content != null ? $data->content = $request->content : $data->content = "Không có";
        
    	
    	$data->save();
    	return back()->with('success', 'Gửi thành công');
    }
    public function postOrder(Request $request){
    	$data = new AdvertOrder;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	$data->address = $request->address_1.' || '.$request->address_2.' || '.$request->address_3;
        $request->address != null ? $request->address_1.' || '.$request->address_2.' || '.$request->address_3 : $data->address = "Không có";
    	$data->no = $request->no;
    	$data->amount = $request->amount;
    	$request->content != null ? $data->content = $request->content : $data->content = "Không có";
    	$data->save();
    	return back()->with('success', 'Gửi thành công');
    }



    public function get_cities(){
        $list_city = DB::table('l_cities')->get();

        return $list_city;
    }

    public function  get_district($city_id){
        $list_district = DB::table('l_districts')->where('matp',$city_id)->get();

        $data = [
            'list_district' => $list_district
        ];

        $view = View::make('client.layouts.district',$data)->render();

        return json_encode([
            'content' => $view
        ]);
    }

    public function get_wards($district_id){
       $list_district = DB::table('l_wards')->where('maqh',$district_id)->get();

       $data = [
           'list_ward' => $list_district
       ];

        $view = View::make('client.layouts.ward',$data)->render();

        return json_encode([
            'content' => $view
        ]);
    }
}
