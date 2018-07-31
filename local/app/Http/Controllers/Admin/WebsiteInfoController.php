<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class WebsiteInfoController extends Controller
{
    public function index(){
        $website_info = DB::table($this->db->web_info)->first();

        $website_info->info = (object)json_decode($website_info->info,true);

        $website_info->updated_at = date('d/m/Y H:m',$website_info->updated_at);

        $website_info->user_updated = DB::table('accounts')->find($website_info->user_id);

        $data = [
            'website_info' => $website_info
        ];
        return view('admin.website_info.index',$data);
    }

    public function add_info(Request $request){
        $data = $request->get('info');
    }

    public function update_info(Request $request){
        $data = $request->get('info');

        $info = WebInfo::first();
        if(!$info){
            return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi cập nhật');
        }else {
            $user = Auth::user();
            $info->user_id = $user->id;
            $info->info = json_encode($data);
            $info->updated_at = time();
            if($info->update()){
                return redirect()->route('website_info')->with('success','Cập nhật thành công');
            }else {
                return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi cập nhật');
            }
        }
    }

    public function delete_info($id){
        $info = WebInfo::find($id);
        if(!$info){
            return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi xóa');
        }else {
            if($info->delete()){
                return redirect()->route('website_info')->with('success','Xóa thành công');
            }else {
                return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi xóa');
            }
        }
    }
}
