<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('admin.index.login');
    }
    public function postLogin(Request $request){
    	$arr = ['username' => $request->username, 'password' => $request->password];

    	
    	if(Auth::attempt($arr, true)){
    		return redirect('admin');
    	}
    	else{
    		return back()->withInput()->with('error','Tài khoản khặc mật khẩu của bạn không đúng');
    	}
    	
    }
    public function getLogout(){
        Auth::logout();
        return back();
    }
}
