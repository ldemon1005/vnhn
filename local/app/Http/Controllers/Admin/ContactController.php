<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdvertContact;
use App\Models\AdvertOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class ContactController extends Controller
{
   	public function getAdvertContact(){
   		$data['items'] = AdvertContact::orderBy('id', 'desc')->paginate(15);
   		return view('admin.contact.advert_contact', $data);
   	}
   	public function getDetailAdvertContact(){
   		$id = Input::get('id');
   		$data = AdvertContact::find($id);
   		return response()->json($data, 201);
   	}

   	public function getAdvertOrder(){
   		$data['items'] = AdvertOrder::orderBy('id', 'desc')->paginate(15);
   		return view('admin.contact.advert_order', $data);
   	}
   	public function getDetailAdvertOrder(){
   		$id = Input::get('id');
   		$data = AdvertOrder::find($id);
   		
   		return response()->json($data, 201);
   	}
}
