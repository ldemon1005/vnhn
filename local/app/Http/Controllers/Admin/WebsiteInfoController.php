<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class WebsiteInfoController extends Controller
{
    public function index(){
        $website_info = DB::table('web_info')->get();

        foreach ($website_info as $value){
            $value->updated_at = date('d/m/Y H:m',$value->updated_at);
        }
        $data = [
            'website_info' => $website_info
        ];
        return view('admin.website_info.index',$data);
    }

    public function add_info(Request $request){
        $data = $request->get('info');
        $data['updated_at'] = time();
        if (WebInfo::create($data)) {
            return redirect()->route('website_info')->with('status','Tạo mới thành công');
        }else {
            return redirect()->route('website_info')->with('error','Tạo mới không thành công');
        }
    }

    public function get_detail($id){
        $info = DB::table('web_info')->find($id);
        $data = [
            'website_info' => $info
        ];
        $view =  View::make('admin.website_info.form_website_info',$data)->render();
        return json_encode([
            'content' => $view
        ]);
    }

    public function update_info(Request $request){
        $data = $request->get('info');
        $info = WebInfo::find($data['id']);
        if(!$info){
            return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi cập nhật');
        }else {
            unset($data['id']);
            $data['updated_at'] = time();
            if($info->update($data)){
                return redirect()->route('website_info')->with('status','Cập nhật thành công');
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
                return redirect()->route('website_info')->with('status','Xóa thành công');
            }else {
                return redirect()->route('website_info')->with('error','Có lỗi xảy ra khi xóa');
            }
        }
    }
}
