<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\GroupNews_vn;
use App\Model\LogFile_vn;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ArticelController extends Controller
{
    public function get_list(Request $request)
    {
        /*
         *  lấy danh sách bài viết
         */
        $paramater = $request->get('articel');

        $group_id = isset($paramater['group_id']) ? $paramater['group_id'] : [];
        $status = isset($paramater['status']) ? $paramater['status'] : [];
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];

        $list_articel = DB::table('news_vn')->orderByDesc('id');

        if(count($status)){
            $list_articel = $list_articel->whereIn('status',$status);
        }

        if(count($group_id)){
            $list_articel_ids = DB::table('group_news_vn')->whereIn('group_vn_id',$group_id)->get(['news_vn_id'])->toArray();
            $list_articel_ids = array_column(json_decode(json_encode($list_articel_ids),true),'news_vn_id');

            $list_articel =  $list_articel->whereIn('id',$list_articel_ids);
        }

        if($key_search){
            $list_articel = $list_articel->where('title','like',"%$key_search%")->orWhere('summary','like',"%$key_search%");
        }

        $list_articel = $list_articel->paginate(15);
        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
        }

        /*
         *  lấy danh sách danh mục
         */
        $list_group = DB::table('group_vn')->where('status', 1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'root'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'articel' => $paramater
        ];

        return view('admin.articel.index', $data);
    }


    public function form_articel($id){
        /*
         *  lấy danh sách danh mục
         */
        $list_group = DB::table('group_vn')->where('status',1)->get()->toArray();
        $this->recusiveGroup($list_group,0,"",$result);
        if($id == 0){
            $data = [
                'id' => 0,
                'title' => '',
                'titlephu' => '',
                'keyword_meta' => '',
                'description_meta' => '',
                'groupid' => [],
                'summary' => '',
                'fimage' => '',
                'tacgia' => '',
                'nguontin' => '',
                'url_nguon' => '',
                'loaiview' => 0,
                'content' => '',
                'release_time' => (object)[
                    'day' => date('d/m/Y',time()),
                    'h' => date('h:i A',time())
                ],
                'hot_main' => 0,
                'hot_item' => 0
            ];
            $articel = (object)$data;
        }else{
            $articel = DB::table('news_vn')->find($id);
            $articel->groupid = explode(',',$articel->groupid);
            $content = DB::table('logfile_vn')->where('LogId',$articel->id)->first();
            $articel->content = $content ? $content->noidung : '';
            $date = $articel->release_time;
            $articel->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
        }
        $data = [
            'articel' => $articel,
            'list_group' => $result
        ];

        return view('admin.articel.form_articel',$data);
    }

    public function action_articel(Request $request){
        $data = $request->get('articel');
        $data['release_time'] = strtotime($data['release_time']['day'].' '.$data['release_time']['h']);
        $status = "Đăng mới";

        $group_id = $data['groupid'];

        $content = $data['content'];
        unset($data['content']);
        $data['groupid'] = join(',',$data['groupid']);

        $user_login = Auth::user();
        $data['userid'] = $user_login->id;

        $data['updated_at'] = time();
        $data['slug'] = str_slug($data['title']);

        // Start transaction
        DB::beginTransaction();
        $check = 1;

        if($data['id'] == 0){ //Tạo mới bài viết
            $data['created_at'] = time();
            $articel = News::create($data);
            if(!$articel->id) $check = 0;
            $data_group_news = [];

            if(count($group_id)){
                foreach ($group_id as $val){
                    $item = [
                        'group_vn_id' => $val,
                        'news_vn_id' => (string)$articel->id
                    ];
                    $data_group_news[] = $item;
                }
            }
            if(count($data_group_news)){
                if(!DB::table('group_news_vn')->insert($data_group_news)) $check = 0;
            }
            $articel->content = $content;
            if(!$this->add_log($articel,$status))$check = 0;

            if($check == 1){
                DB::commit();
                return redirect()->route('admin_articel')->with('status','Tạo mới thành công');
            }else {
                DB::rollBack();
                $data['content'] = $content;
                $date = $data['release_time'];
                $data['release_time']['day'] = date('d/m/Y',$date);
                $data['release_time']['h'] = date('h:i A',$date);
                $data['groupid'] = $group_id;
                return redirect()->route('form_articel',0)->with('error','Cập nhật không thành công')->with('data',((object)$data));
            }
        }else { //Cập nhật bài viết
            $articel = News::find($data['id']);
            if(!$articel){
                return redirect()->route('admin_articel')->with('error','Có lỗi xảy ra');
            }else {
                $data['updated_at'] = time();

                if(!$articel->update($data)){$check = 0;}

                if(DB::table('group_news_vn')->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

                $data_group_news = [];

                if(count($group_id)){
                    foreach ($group_id as $val){
                        $item = [
                            'group_vn_id' => $val,
                            'news_vn_id' => (string)$articel->id
                        ];
                        $data_group_news[] = $item;
                    }
                }

                if(count($data_group_news)){
                    if(!DB::table('group_news_vn')->insert($data_group_news)){$check = 0;}
                }

                $articel->content = $content;
                if(!$this->add_log($articel,$status)) $check = 0;
                if($check == 1){
                    DB::commit();
                    return redirect()->route('admin_articel')->with('status','Cập nhật thành công');
                }else {
                    DB::rollBack();
                    $data['content'] = $content;
                    $date = $data['release_time'];
                    $data['release_time']['day'] = date('d/m/Y',$date);
                    $data['release_time']['h'] = date('h:i A',$date);
                    $data['groupid'] = $group_id;
                    return redirect()->route('form_articel',$articel->id)->with('error','Cập nhật không thành công')->with('data',$data);
                }
            }
        }
    }

    public function delete_articel($id){
        $articel = News::find($id);
        DB::beginTransaction();
        $check = 1;

        if(DB::table('logfile_vn')->where('LogId',$id)->delete() <= 0) $check = 0;

        if(DB::table('group_news_vn')->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

        if(!$articel->delete()) $check = 0;

        if($check == 1){
            DB::commit();
            return redirect()->route('admin_articel')->with('status','Xóa thành công');
        }else {
            DB::rollBack();
            return redirect()->route('admin_articel')->with('error','Xóa không thành công');
        }

    }

    public function add_log($articel,$status){
        $user_login = Auth::user();
        $log_data = [
            'LogId' => $articel->id,
            'userId' => $user_login->id,
            'created_at' => time(),
            'noidung' => $articel->content,
            'groupid' => $articel->groupid,
            'title' => $articel->title
        ];

        if(LogFile_vn::create($log_data)){
            return true;
        }else return false;
    }

    public function history_articel($id){
        $log = DB::table('logfile_vn')->where('LogId',$id)->paginate(8);
        foreach ($log as $item){
            $item->created_at = date('d/m/Y H:m',$item->created_at);
            $user = DB::table('accounts')->find($item->userId);
            $item->user = $user;
        }

        $data = [
            'list_history' => $log
        ];
        $view =  View::make('admin.articel.history_news', $data)->render();
        return json_encode([
            'content' => $view
        ]);
    }

    function view_log($id){
        $log = DB::table('logfile_vn')->find($id);
        $data = [
            'log' => $log
        ];

        return view('admin.articel.view_articel', $data);
    }

    public function sort_hot_articel()
    {
        /*
 *  lấy danh sách danh mục
 */
        $list_group = DB::table('group_vn')->where('status', 1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'Trang chủ'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        $arrticel_hot = DB::table('news_vn')->where('hot_main',1)->orderBy('order_main')->paginate(20);

        $data = [
            'list_articel' => $arrticel_hot,
            'list_group' => $result,
            'group_id' => 0
        ];

        return view('admin.articel.sort_articel',$data);
    }

    public function sort_hot_articel_post(Request $request)
    {
        $group_id = $request->get('groupid');

        /*
 *  lấy danh sách danh mục
 */
        $list_group = DB::table('group_vn')->where('status', 1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'Trang chủ'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        if($group_id == 0){
            $arrticel_hot = DB::table('news_vn')->where('hot_main',1)->orderBy('order_main')->get();
        }else {
            $articel_hot_ids = DB::table('group_news_vn')->where('group_vn_id',$group_id)->where('hot',1)->get(['news_vn_id'])->toJson();

            $articel_hot_ids = array_column(json_decode($articel_hot_ids,true),'news_vn_id');

            $arrticel_hot = DB::table('news_vn')->whereIn('id',$articel_hot_ids)->orderBy('hot_item')->get();
        }

        $data = [
            'list_articel' => $arrticel_hot,
            'list_group' => $result,
            'group_id' => $group_id
        ];

        return view('admin.articel.sort_articel',$data);
    }

    public function update_order_articel(Request $request){
        $data = $request->get('articel');
        if($data['groupid'] == null){
            unset($data['groupid']);
            foreach ($data as $key => $val){
                DB::table('news_vn')->where('id',$key)->update(['order_main' => $val]);
            }
        }else {
            unset($data['groupid']);
            foreach ($data as $key => $val){
                DB::table('news_vn')->where('id',$key)->update(['order_item' => $val]);
            }
        }
        return redirect()->route('sort_hot_articel' )->with('status','Sắp xếp thành công');
    }

    public function delete_articel_hot($groupid,$id){
        if($groupid == 0){
            if(DB::table('news_vn')->where('id',$id)->update(['hot_main' => 0])){
                return redirect()->route('sort_hot_articel' )->with('status','Xóa thành công');
            }else return redirect()->route('sort_hot_articel' )->with('error','Xóa không thành công');
        }else {
            if(DB::table('news_vn')->where('id',$id)->update(['hot_item' => 0])){
                return redirect()->route('sort_hot_articel' )->with('status','Xóa thành công');
            }else return redirect()->route('sort_hot_articel' )->with('error','Xóa không thành công');
        }
    }
}
