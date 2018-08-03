<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MagazineController extends Controller
{
    public function getHome(){
    	return view('magazine.index.index');
    }
}
