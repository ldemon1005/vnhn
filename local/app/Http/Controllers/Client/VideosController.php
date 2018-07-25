<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class VideosController extends Controller
{
    function index(){
        return view('client.videos.index');
    }

    function open_video($id){
        $video = DB::table('video_vn')->find($id);
        $data = [
            'video' => $video
        ];
        return view('client.layouts.video', $data);
    }
}
