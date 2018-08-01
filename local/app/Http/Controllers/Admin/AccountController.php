<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountAddRequest;
use App\Http\Requests\AccountEditRequest;

use App\Models\Account;

use File;
use Auth;
use DB;
class AccountController extends Controller
{
    public function getList(){
        if (Auth::user()->level == 1) {
            $data['items'] = Account::where('level', '>=', Auth::user()->level)->get();
        }
        else{
            $data['items'] = Account::where('level', '>=', Auth::user()->level)->where('site', Auth::user()->site)->get();
        }
    	return view('admin.account.account', $data);
    }
    public function getAdd(){
        $group_id = Auth::user()->group_id;
        $group_id = explode(',', $group_id);
        
        if (in_array(0 ,$group_id)) {
            $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->where('parentid', '0')->get()->toArray();
            $root = [
                'id' => 0,
                'title' => 'root'
            ];
            $result[] = (object)$root;
            $this->recusiveGroup($list_group, 0, "", $result);
            $data['list_group'] = $result;

        }
        else{
            $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->where('parentid', '0')->whereIn('id', $group_id)->get()->toArray();
            $data['list_group'] = $list_group;
        }
        // dd($data['list_group']);

    	return view('admin.account.account_form',$data);
    }
    public function postAdd(AccountAddRequest $request){
    	$acc = new Account;
    	$acc->username = $request->username;
    	$acc->fullname = $request->fullname;
        if ($request->email != null) {
            $acc->email = $request->email;
        }
    	
    	$acc->phone = $request->phone;
    	$acc->password = bcrypt($request->password);
    	$acc->level = $request->level;
    	$acc->status = 1;
        if ($request->group_id != null) {
            $acc->group_id = implode(",", $request->group_id);
        }
        
        // site : các bên khác nhau
        if (Auth::user()->level == 1) {
            $acc->site = $request->site;
        }
        else{
            $acc->site = Auth::user()->site;
        }
    	$image = $request->file('img');
        if ($request->hasFile('img')) {
            $acc->img = saveImage([$image], 100, 'avatar');
        }
        $acc->save();

    	return redirect('admin/account')->with('success','Thêm tài khoản thành công');
    }
    public function getEdit($id){
    	$data['item'] = Account::find($id);
        $group_id = Auth::user()->group_id;
        $group_id = explode(',', $group_id);
        
        $data['gr_acc'] = Account::find($id)->group_id;
        $data['gr_acc'] = explode(',', $data['gr_acc']);
        if (in_array(0 ,$group_id)) {
            $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->where('parentid', '0')->get()->toArray();
            $root = [
                'id' => 0,
                'title' => 'root'
            ];
            $result[] = (object)$root;
            $this->recusiveGroup($list_group, 0, "", $result);
            $data['list_group'] = $result;
        }
        else{
            $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->where('parentid', '0')->whereIn('id', $group_id)->get()->toArray();
            $data['list_group'] = $list_group;
        }
        $data['group_id'] = $group_id;
    	return view('admin.account.account_form', $data);
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
        if ($request->group_id != null) {
            $acc->group_id = implode(",", $request->group_id);
        }
        // site : các bên khác nhau
        if (Auth::user()->level == 1) {
            $acc->site = $request->site;
        }
        else{
            $acc->site = Auth::user()->site;
        }

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
