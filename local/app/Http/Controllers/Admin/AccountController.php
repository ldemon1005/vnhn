<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountAddRequest;
use App\Http\Requests\AccountEditRequest;

use App\Models\Account;

use File;

class AccountController extends Controller
{
    public function getList(){
    	$data['items'] = Account::all();
    	return view('admin.account.account', $data);
    }
    public function getAdd(){
    	return view('admin.account.account_add');
    }
    public function postAdd(AccountAddRequest $request){
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
    	return view('admin.account.account_edit', $data);
    }
    public function postEdit(AccountEditRequest $request, $id){
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
    public function getDelete($id){
        $acc = Account::find($id);
        $filename = $acc->img;
        File::delete('libs/storage/app/news/'.$filename);
        File::delete('libs/storage/app/news/resized-'.$filename);
        $acc->delete();
        return back()->with('success', 'Xóa tài khoản thành công');
    }
}
