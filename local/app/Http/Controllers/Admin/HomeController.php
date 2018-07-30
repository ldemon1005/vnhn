<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getHome(){
        return view('admin.index.home');
    }
}
