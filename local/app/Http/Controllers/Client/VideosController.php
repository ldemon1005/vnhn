<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    function index(){
        return view('client.videos.index');
    }
}
