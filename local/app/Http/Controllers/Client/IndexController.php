<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('client.index.index');
    }
    public function time(){
    	return view('client.index.time');
    }
}
