<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
class AccountController extends Controller
{
    public function getList(){
    	$data['items'] = Account::all();
    	return view('admin.index.account', $data);
    }
    public function getAdd(){
    	return view('admin.index.account_add');
    }
    public function postAdd(Request $request){
    	$acc = new Account;
    	$acc->username = $request->username;
    	$acc->fullname = $request->fullname;
    	$acc->email = $request->email;
    	$acc->phone = $request->phone;
    	$acc->password = bcrypt($request->password);
    	$acc->level = $request->level;
    	$acc->status = 1;
    	$image = $request->file('img');
        if ($request->hasFile('img')) {
            $acc->img = saveImage([$image], 100, 'avatar');
        }
        $acc->save();

    	return redirect('admin/account')->with('success','Thêm tài khoản thành công');
    }
    public function getEdit($id){
    	$data['item'] = Account::find($id);
    	return view('admin.index.account_edit', $data);
    }
    public function postEdit(Request $request, $id){
    	$acc = Account::find($id);
    	$acc->username = $request->username;
    	$acc->fullname = $request->fullname;
    	$acc->email = $request->email;
    	$acc->phone = $request->phone;
    	if ($request->password != null) {
    		$acc->password = bcrypt($request->password);
    	}
    	$acc->level = $request->level;
    	$acc->status = 1;
    	$image = $request->file('img');
        if ($request->hasFile('img')) {
            $acc->img = saveImage([$image], 100, 'avatar');
        }
        $acc->save();

    	return redirect('admin/account')->with('success','Sửa tài khoản thành công');
    }
}
