<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('client.index.index');
    }
    public function getGroup($slug){
    	$arr = explode('_', $slug);
		if (isset($arr[1])) {
			return view('client.index.detail');
			
		}
		else{
			return view('client.index.time');
		}
    	
    }
}
