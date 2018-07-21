<?php

namespace App\Http\Controllers\Admin;

use App\Models\Magazine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MagazineController extends Controller
{
    public function index(){
        $list_magazine = DB::table('magazine_vn')->paginate(10);
        foreach ($list_magazine as $val){
            $val->created_at = date('d/m/Y H:m',$val->created_at);
            $val->slide_show = json_decode($val->slide_show,true);
        }
        $data = [
            'list_magazine' => $list_magazine
        ];
        return view('admin.magazine.index',$data);
    }

    public function form_magazine($id){
        $list_group = DB::table('group_vn')->where('status', 1)->where('parentid','00')->get()->toArray();

        if($id == 0){
            $data = [
                'id' => 0,
                'title' => '',
                'groupid' => '',
                'slide_show' => [],
                'status' => 1
            ];
            $magazine = (object)$data;
        }else{
            $magazine = DB::table('magazine_vn')->find($id);
            $magazine->slide_show = json_decode($magazine->slide_show,true);
        }

        $data = [
            'magazine' => $magazine,
            'list_group' => $list_group
        ];

        return view('admin.magazine.form_magazine',$data);
    }

    public function action_magazine(Request $request){
        $data = $request->get('magazine');

        $data['slide_show'] = json_encode($data['slide_show']);

        $data['created_at'] = time();

        $data['slug'] = str_slug($data['title']);

        if($data['id'] == 0){
            unset($data['id']);
            if(Magazine::create($data)){
                return redirect()->route('admin_magazine')->with('success','Tạo mới thành công');
            }else {
                return redirect()->route('form_magazine')->with('error','Tạo mới không thành công thành công');
            }
        }else {
            $magazine = Magazine::find($data['id']);

            if($magazine->update($data)){
                return redirect()->route('admin_magazine')->with('success','Cập nhật thành công');
            }else {
                return redirect()->route('admin_magazine')->with('error','Cập nhật không thành công thành công');
            }
        }
    }

    public function delete_magazine($id){
        $magazine = Magazine::find($id);

        if($magazine->delete()){
            return redirect()->route('admin_magazine')->with('success','Xóa thành công');
        }else {
            return redirect()->route('admin_magazine')->with('error','Xóa không thành công thành công');
        }
    }
}
