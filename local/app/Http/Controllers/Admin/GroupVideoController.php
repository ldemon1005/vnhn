<?php

namespace App\Http\Controllers\Admin;

use App\Models\MenuVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;


class GroupVideoController extends Controller
{
    function index(){
        $list_group = DB::table($this->db->menu_video)->orderByDesc('id')->orderBy('order')->paginate(15);

        foreach ($list_group as $group){
            $group->created_at = date('d/m/Y H:m',$group->created_at);
        }
        $data = [
            'list_group' => $list_group
        ];
        return view('admin.group_video.index',$data);
    }

    function form_group_video($id){
        if($id == 0){
            $data = [
                'id' => 0,
                'title' => '',
                'icon' => '',
                'status' => 1
            ];
            $group_video = (object)$data;
        }else {
            $group_video = DB::table($this->db->menu_video)->find($id);
        }

        $data = [
            'group_video' => $group_video
        ];
        $view = View::make('admin.group_video.form_menu_video',$data)->render();
        return json_encode([
            'content' => $view
        ]);
    }

    function action_menu_video(Request $request){
        $data = $request->get('menu_video');
        $data['slug'] = str_slug($data['title']);
        if($data['id'] == 0){
            $data['created_at'] = time();
            unset($data['id']);
            if(MenuVideo::create($data)){
                return redirect()->route('admin_video_group')->with('success','Tạo mới thành công');
            }else {
                return redirect()->route('admin_video_group')->with('error','Tạo mới không thành công');
            }
        }else {
            $menu_video = MenuVideo::find($data['id']);
            if($menu_video->update($data)){
                return redirect()->route('admin_video_group')->with('success','Cập nhật thành công');
            }else {
                return redirect()->route('admin_video_group')->with('error','Cập nhật không thành công');
            }
        }
    }

    function delete_menu($id){
        if(DB::table($this->db->menu_video)->delete($id)){
            return redirect()->route('admin_video_group')->with('success','Xóa thành công');
        }else {
            return redirect()->route('admin_video_group')->with('error','Xóa không thành công');
        }
    }

    function form_sort(){
        $list_menu = DB::table($this->db->menu_video)->orderBy('order')->where('status',1)->get();
        $data = [
            'list_menu' => $list_menu
        ];
        return view('admin.group_video.sort_menu_video',$data);
    }

    function sort_menu(Request $request){
        $data = $request->get('menu_video');
        $check = 1;
        foreach ($data as $key => $val){
            if(!MenuVideo::find($key)->update(['order' => $val])) $check = 0;
        }
        if($check == 1){
            return redirect()->route('form_sort' )->with('success','Sắp xếp thành công');
        }else{
            return redirect()->route('form_sort')->with('error','Sắp xếp không thành công');
        }
    }


    public function getOn(){
        $id = Input::get('id');
        $gr = MenuVideo::find($id);
        $gr->status = 1;
        $gr->save();
        return response($id, 200);
    }
    public function getOff(){
        $id = Input::get('id');
        $gr = MenuVideo::find($id);
        $gr->status = 0;
        $gr->save();
        return response('ok', 200);
    }
}