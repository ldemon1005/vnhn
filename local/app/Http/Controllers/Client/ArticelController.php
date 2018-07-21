<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticelController extends Controller
{
    public function get_detail($slug){

        $slug = explode('--',$slug);

        return view('client.articel.detail');
    }
}
