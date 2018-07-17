<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Http\Requests\ProfileEditRequest;

use Auth;
class ProfileController extends Controller
{
    public function getDetail(){
    	$data['item'] = Account::find(Auth::user()->id);
    	return view('admin.profile.profile', $data);
    }
    public function postDetail(ProfileEditRequest $request){
    	$acc = Account::find(Auth::user()->id);
    	$acc->username = $request->username;
    	$acc->fullname = $request->fullname;
    	$acc->email = $request->email;
    	$acc->phone = $request->phone;
    	$image = $request->file('img');
        if ($request->hasFile('img')) {
            $acc->img = saveImage([$image], 100, 'avatar');
        }
        $acc->save();
    	return back()->with('success','Sửa tài khoản thành công');
    }
    public function getChangePass(){
    	$data['item'] = Account::find(Auth::user()->id);
    	return view('admin.profile.profile_change_pass', $data);
    }
    public function postChangePass(Request $request){
    	$arr = ['username' => Auth::user()->username, 'password' => $request->old_password];
    	// dd($request->old_password);
    	if(Auth::attempt($arr, true)){
    		if ($request->new_password == $request->re_new_password) {
    			$acc = Account::find(Auth::user()->id);
	    		$acc->password = bcrypt($request->new_password);
	    		$acc->save();
	    		
    			return back()->with('success', 'Thay đổi mật khẩu thành công');
    		}
    		else{
    			return back()->withInput()->with('error','Nhập lại mật khẩu mới không trùng khớp');
	    	}	
    	}
    	else{
    		return back()->withInput()->with('error','Mật khẩu cũ không đúng');
    	}
    		
    	
    }
}
