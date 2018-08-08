<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mockery\Exception;
use Auth;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller
{
    public function getList(Request $request){
        $group_id = Auth::user()->group_id;
        $group_id = explode(',', $group_id);

        $parentid = $request->get('groupid');


        if (in_array(0 ,$group_id)) {
            $list_group = DB::table($this->db->group)->where('parentid', '0')->get()->toArray();
            $root = [
                'id' => 0,
                'title' => 'root'
            ];
            $result[] = (object)$root;
            $this->recusiveGroup($list_group, 0, "", $result);
            // $data['list_group'] = $result;

            if($parentid != null){
                $list_group = DB::table($this->db->group)->where('parentid',$parentid)->orderByDesc('id')->paginate(15);
            }else {
                $list_group = DB::table($this->db->group)->orderByDesc('id')->paginate(15);
            }
            
        }
        else{
            $list_group = DB::table($this->db->group)->where('parentid', '0')->whereIn('id', $group_id)->get()->toArray();
            $result = $list_group;

            if($parentid != null){
                $list_group = DB::table($this->db->group)->where('parentid', '0')->where('parentid',$parentid)->orderByDesc('id')->paginate(15);
            }else {
                $list_group = DB::table($this->db->group)->where('parentid', '0')->whereIn('id', $group_id)->orderByDesc('id')->paginate(15);
            }
        }
        
        //dd($parentid);
        // $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        // $root = [
        //     'id' => 0,
        //     'title' => 'root'
        // ];
        // $result[] = (object)$root;
        // $this->recusiveGroup($list_group,0,"",$result);

        foreach ($list_group as $value){
            $value->created_at = date('d/m/Y h:m');
        }
        $data = [
            'list_group' => $list_group->appends(['groupid' => $parentid]),
            'groups' => $result,
            'parentid' => $parentid
        ];
        return view("admin.group.index",$data);
    }

    function check_has_chlid($list_group,$id){
        foreach ($list_group as $value){
            if($value->parentid == $id){
                return true;
            }
        }
        return false;
    }

    public function form_group($id){
        if (Auth::check() && Auth::user()->site == 1) {
           $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->get()->toArray();
            $root = [
                'id' => 0,
                'title' => 'root'
            ];
            $result[] = (object)$root;
            $this->recusiveGroup($list_group,0,"",$result);

            if($id == 0){
                $group = [
                    'id' => 0,
                    'title' => '',
                    'avatar' => '',
                    'slug' => '',
                    'summary' => '',
                    'parentid' => '0',
                    'keywords' => '',
                    'titlemeta' => '',
                    'status' => 1,
                    'hot_index' => 0
                ];

                $group = (object)$group;
            }else {
                $group = DB::table($this->db->group)->find($id);
            }

            $data = [
                'list_group' => $result,
                'group' => $group
            ];
            return view('admin.group.form_group',$data);
        }
        else{
            return redirect('admin/group');
        }
            
    }

    public function action_group(Request $request){
        $data = $request->get('group');
        $id = $data['id'];
        unset($data['id']);
        $data['slug'] = str_slug($data['title']);
        $data['updated_at'] = time();
        if($id == 0){
            $data['created_at'] = time();
            try{
                $group = Group_vn::create($data);
                if($group){
                    return redirect()->route('admin_group')->with('status','Tạo mới thành công');
                }
            }catch (Exception $e){
                return redirect()->route('form_group')->with('error','Tạo mới không thành công');
            }
        }else {
            $group = Group_vn::find($id);
            if(!$group){
                return redirect()->route('form_group')->with('error','Có lỗi xảy ra');
            }else {
                if ($group->update($data)){
                    return redirect()->route('admin_group')->with('status','Cập nhật thành công');
                }else {
                    return redirect()->route('form_group')->with('error','Có lỗi xảy ra');
                }

            }
        }
    }

    function delete_group($id){
        if(DB::table($this->db->group)->delete($id)){
            return redirect()->route('admin_group')->with('status','Xóa thành công');
        }
        return redirect()->route('admin_group')->with('error','Xóa không thành công');
    }

    function form_sort_group($parent_id = 0){
        if($parent_id == 0){
            $list_group = DB::table($this->db->group)->where('home_index',1)->orderBy('order')->get();

            $data = [
                'list_group' => $list_group
            ];
            return view('admin.group.sort_group',$data);
        }else {
            $list_group = DB::table($this->db->group)->where('parentid',$parent_id)->orderBy('order')->get();
            $group_parent = DB::table($this->db->group)->find($parent_id);
            $data = [
                'list_group' => $list_group,
                'group_parent' => $group_parent
            ];
            $view =  View::make('admin.group.child_group', $data)->render();
            return json_encode([
                'content' => $view
            ]);
        }
    }

    function form_sort_group_category($parent_id = 0){
        if($parent_id == 0){
            $list_group = DB::table($this->db->group)->where('parentid',0)->orderBy('order')->get();

            $data = [
                'list_group' => $list_group
            ];
            return view('admin.group.sort_group_cate',$data);
        }else {
            $list_group = DB::table($this->db->group)->where('parentid',$parent_id)->orderBy('order')->get();
            $group_parent = DB::table($this->db->group)->find($parent_id);
            $data = [
                'list_group' => $list_group,
                'group_parent' => $group_parent
            ];
            $view =  View::make('admin.group.child_group_cate', $data)->render();
            return json_encode([
                'content' => $view
            ]);
        }
    }

    public function delete_home_index($id){
        if(DB::table($this->db->group)->where('id',$id)->update(['home_index' => 0])){
            return redirect()->route('form_sort_group',0)->with('success','Xóa thành công');
        }else {
            return redirect()->route('form_sort_group',0)->with('error','Xóa không thành công');
        }
    }

    public function update_order(Request $request){
        $cate = $request->get('cate',0);

        $data = $request->get('group');
        $check = 1;
        foreach ($data as $key => $item){
            isset($data['parentid']) ? $order = $data['parentid'].$item : $order = $item;
            DB::table($this->db->group)->where('id',$key)->update(['order' => $order]);
        }
        if($cate == 0){
            if($check == 1){
                return redirect()->route('form_sort_group', '00' )->with('success','Sắp xếp thành công');
            }else {
                return redirect()->route('form_sort_group', '00')->with('error','Sắp xếp không thành công');
            }
        }else {
            if($check == 1){
                return redirect()->route('form_sort_group_category', '00' )->with('success','Sắp xếp thành công');
            }else {
                return redirect()->route('form_sort_group_category', '00')->with('error','Sắp xếp không thành công');
            }
        }

    }

    public function getOn(){
        $id = Input::get('id');
        $gr = Group_vn::find($id);
        $gr->status = 1;
        $gr->save();
        return response($id, 200);
    }
    public function getOff(){
        $id = Input::get('id');
        $gr = Group_vn::find($id);
        $gr->status = 0;
        $gr->save();
        return response('ok', 200);
    }
}
