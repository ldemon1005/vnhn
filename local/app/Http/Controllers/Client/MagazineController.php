<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Emagazine;
use Illuminate\Support\Facades\Input;

class MagazineController extends Controller
{
    public function getHome(Request $request){
    	
    	

    	$data['items'] = Emagazine::orderBy('e_hot', 'asc')->take(9)->skip(0)->get();
    	return view('magazine.index.index', $data);
    }
    public function getDetail($slug){
    	$data['item'] = Emagazine::where('e_slug', $slug)->first();
    	if (isset($data['item']) && $data['item']!=null) {
    		return view('magazine.index.detail', $data);
    	}
    	else{
    		return back()->with('error', 'Đã xảy ra lỗi');
    	}
    }
    public function load_more(){
        $count = Input::get('count');
        $data['items'] = Emagazine::orderBy('e_hot', 'asc')->take(9)->skip($count*9)->get();
    	return response()->json($data['items'], 200);

    }

}
