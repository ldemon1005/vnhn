<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\GroupNews_vn;
use App\Model\LogFile_vn;
use App\Model\News;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

class ArticelController extends Controller
{
    public function get_list(Request $request)
    {
        
        /*
         *  lấy danh sách danh mục
         */
        $user = Auth::user();
        $group_ids = explode(',',$user->group_id);
        if($user->group_id == '0'){
            $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        }else {
            $list_group = DB::table($this->db->group)->where('status', 1)->where(function ($query) use ($group_ids){
                $query->whereIn('id',$group_ids)
                      ->orWhereIn('parentid',$group_ids);
            })->get()->toArray();
        }
        if (count($list_group)) $this->recusiveGroup($list_group,0,"",$result);
        else $result = [];
        

        if (in_array(0 ,$group_ids)) {
            $group_ids = [];
        }
        else{
            
            foreach ($list_group as $group) {
                $group_ids[] = (int)$group->id;
            }
            
        }

        /*
         *  lấy danh sách bài viết
         */

        switch (Auth::user()->level) {
            case 1:
                $status = [];
                break;
            case 2:
                $status = [0,1];
                break;
            case 3:
                $status = [0,2,3];
                break;
            case 4:
                $status = [0,3,4];
                break;

            default:
                # code...
                break;
        }
        $paramater = $request->all();

        if (isset($paramater['articel'])){
            $paramater = $paramater['articel'];
        }

        $paramater_return = $paramater;



        $group_id = isset($paramater['group_id']) ? $paramater['group_id'] : $group_ids;
        $status = isset($paramater['status']) ? $paramater['status'] : $status;
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            $list_articel = $list_articel->whereIn('status',$status);
        }



        if(count($group_id)){
            $list_articel_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$group_id)->get(['news_vn_id'])->toArray();
            $list_articel_ids = array_column(json_decode(json_encode($list_articel_ids),true),'news_vn_id');

            $list_articel =  $list_articel->whereIn('id',$list_articel_ids);

        }

        if($key_search){
            $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('title','like',"%$key_search%")
                      ->orWhere('summary', 'like', "%$key_search%");
            });
            // dd($list_articel->get());
        }
        if (Auth::user()->level > 2) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }

        $list_articel = $list_articel->paginate(15);
        // dd($list_articel);
        if(isset($paramater_return['status'])){
            $list_articel->appends(['status' => $paramater_return['status']]);
        }
        if(isset($paramater_return['group_id'])){
            $list_articel->appends(['group_id' => $paramater_return['group_id']]);
        }
        if(isset($paramater_return['key_search'])){
            $list_articel->appends(['key_search' => $paramater_return['key_search']]);
        }

        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
        }
        
        

        


        if(!$paramater){
            $paramater = [
                'key_search' => '',
                'group_id' => [],
                'status' => []
            ];
        }

        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'paramater' => $paramater,
        ];
        for ($i=0; $i < count($data['list_articel']); $i++) { 
            $data['list_articel'][$i]->username = Account::find($data['list_articel'][$i]->userid);
        }
        // foreach ($data['list_articel'] as $articel) {
        //     $ar = News::find($articel->id);
        //     $ar->groupid = 1455;
        //     $ar->save();
        // }
        
        // dd($data['list_articel'][0]);
        return view('admin.articel.index', $data);
    }

    public function approved(Request $request){
        $group_ids = Auth::user()->group_id;
        $group_ids = explode(',', $group_ids);



        $user = Auth::user();
        $group_ids = explode(',',$user->group_id);
        if($user->group_id == '0'){
            $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        }else {
            $list_group = DB::table($this->db->group)->where('status', 1)->whereIn('id',$group_ids)->orWhereIn('parentid',$group_ids)->get()->toArray();
        }
        // dd($list_group);
        if (count($list_group)) $this->recusiveGroup($list_group,0,"",$result);
        else $result = [];
        foreach ($list_group as $item) {
            $list_group_id[] = $item->id;
        }
        // dd($list_group_id);
        if(isset($list_group_id)){
            if (in_array(0 ,$list_group_id)) {
                $list_group_id = [];
            }
        }
        else{
            return redirect('admin');
        }
        
        /*
         *  lấy danh sách bài viết
         */

        switch (Auth::user()->level) {
            case 1:
                $status = [2,3];
                break;
            case 2:
                $status = [2];
                break;
            case 3:
                $status = [3];
                break;
            case 4:
                $status = [0,3,4];
                break;

            default:
                # code...
                break;
        }
        $paramater = $request->get('articel');
        // dd($paramater['group_id']);
        // dd($group_ids);
        $list_group_id = isset($paramater['group_id']) ? $paramater['group_id'] : $list_group_id;
        $status = isset($paramater['status']) ? $paramater['status'] : $status;
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            $list_articel = $list_articel->whereIn('status',$status);
        }

        if(count($list_group_id)){
            // dd($group_id);
            $list_articel_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$list_group_id)->get(['news_vn_id'])->toArray();
            $list_articel_ids = array_column(json_decode(json_encode($list_articel_ids),true),'news_vn_id');

            $list_articel =  $list_articel->whereIn('id',$list_articel_ids );
            // dd($list_articel->get());

        }

        if($key_search){
            $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('title','like',"%$key_search%")
                      ->orWhere('summary', 'like', "%$key_search%");
            });
            // dd($list_articel->get());
        }
        if (Auth::user()->level == 4) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }

        $list_articel = $list_articel->paginate(15);
        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
        }
        
        /*
         *  lấy danh sách danh mục
         */



        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'articel' => $paramater
        ];
        for ($i=0; $i < count($data['list_articel']); $i++) { 
            $data['list_articel'][$i]->username = Account::find($data['list_articel'][$i]->userid);
        }
        // foreach ($data['list_articel'] as $articel) {
        //     $ar = News::find($articel->id);
        //     $ar->groupid = 1455;
        //     $ar->save();
        // }
        
        // dd($data['list_articel'][0]);
        return view('admin.articel.index', $data);
    }

    public function approved_cgroup(Request $request){
        $group_ids = Auth::user()->group_id;
        $group_ids = explode(',', $group_ids);



        $user = Auth::user();
        $group_ids = explode(',',$user->group_id);
        if($user->group_id == '0'){
            $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        }else {
            $list_group = DB::table($this->db->group)->where('status', 1)->where(function ($query) use ($group_ids){
                $query->whereNotIn('id',$group_ids)
                      ->whereNotIn('parentid',$group_ids);
            })->get()->toArray();
        }
        
        if (count($list_group)) $this->recusiveGroup($list_group,0,"",$result);
        else $result = [];
        foreach ($list_group as $item) {
            $list_group_id[] = $item->id;
        }
        // dd($list_group_id);
        if(isset($list_group_id)){
            if (in_array(0 ,$list_group_id)) {
                $list_group_id = [];
            }
        }
        else{
            return redirect('admin');
        }
        
        /*
         *  lấy danh sách bài viết
         */

        switch (Auth::user()->level) {
            
            case 2:
                $status = [2];
                break;
            
            default:
                return redirect('');
                break;
        }
        $paramater = $request->get('articel');
        // dd($paramater['group_id']);
        // dd($group_ids);
        $list_group_id = isset($paramater['group_id']) ? $paramater['group_id'] : $list_group_id;
        // $status = isset($paramater['status']) ? $paramater['status'] : $status;
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            $list_articel = $list_articel->whereIn('status',$status);
        }

        if(count($list_group_id)){
            // dd($group_id);
            $list_articel_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$list_group_id)->get(['news_vn_id'])->toArray();
            $list_articel_ids = array_column(json_decode(json_encode($list_articel_ids),true),'news_vn_id');

            $list_articel =  $list_articel->whereIn('id',$list_articel_ids );
            // dd($list_articel->get());

        }

        if($key_search){
            $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('title','like',"%$key_search%")
                      ->orWhere('summary', 'like', "%$key_search%");
            });
            // dd($list_articel->get());
        }
        if (Auth::user()->level == 4) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }

        $list_articel = $list_articel->paginate(15);
        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
        }
        
        /*
         *  lấy danh sách danh mục
         */



        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'articel' => $paramater
        ];
        for ($i=0; $i < count($data['list_articel']); $i++) { 
            $data['list_articel'][$i]->username = Account::find($data['list_articel'][$i]->userid);
        }
        // foreach ($data['list_articel'] as $articel) {
        //     $ar = News::find($articel->id);
        //     $ar->groupid = 1455;
        //     $ar->save();
        // }
        
        // dd($data['list_articel'][0]);
        return view('admin.articel.index', $data);
    }

    public function form_articel($id){
        /*
         *  lấy danh sách danh mục
         */

        $user = Auth::user();
        $group_ids = explode(',',$user->group_id);
        if($user->group_id == '0'){
            $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        }else {
            $list_group = DB::table($this->db->group)->where('status', 1)->where(function ($query) use ($group_ids){
                $query->whereIn('id',$group_ids)
                      ->orWhereIn('parentid',$group_ids);
            })->get()->toArray();
        }
        if (count($list_group)) $this->recusiveGroup($list_group,0,"",$result);
        else $result = [];

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
                'content' => '',
                'release_time' => (object)[
                    'day' => date('Y-m-d',time()),
                    'h' => date('h:i A',time())
                ],
                'hot_main' => 0,
                'hot_item' => 0,
                'loaitinbai' => 1,
                'time_hot_main' => 2,
                'time_hot_item' => 2
            ];
            $articel = (object)$data;
        }else{
            $articel = DB::table($this->db->news)->find($id);
            $articel->groupid = explode(',',$articel->groupid);
            $content = DB::table($this->db->logfile)->orderByDesc('id')->where('LogId',$articel->id)->first();
            $articel->content = $content ? $content->noidung : '';
            $date = $articel->release_time;
            $articel->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];

            $articel->time_hot_main = round(($articel->time_hot_main - time())/3600) >= 0  ? intval(ceil(($articel->time_hot_main - time())/3600)) : 0;
            $articel->time_hot_item = round(($articel->time_hot_item - time())/3600) >= 0 ? intval(ceil(($articel->time_hot_item - time())/3600)) : 0;
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

        // $status = $this->get_status()['status'];

        
        $status_str = $this->get_status()['status_str'];
        switch (Auth::user()->level) {
            case 1:
                $status = 1;
                break;
            case 2:
                $status = 1;
                break;
            case 3:
                $status = 2;
                break;
            case 4:
                $status = 3;
                break;
            default:
                $status = 0;
                break;
        }
        $data['status'] = $status;
        $group_id = $data['groupid'];

        $content = $data['content'];
        unset($data['content']);
        $data['groupid'] = join(',',$data['groupid']);

        $user_login = Auth::user();
        $data['userid'] = $user_login->id;

        $data['updated_at'] = time();
        $data['slug'] = str_slug($data['title']);
        
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $data['fimage'] = saveImageArticle([$image], 'article');
        }


        if(!isset($data['hot_main'])) {
            $data['hot_main'] = 0;
            $data['time_hot_main'] = 0;
        }
        else {
            $data['order_main'] = 1;
            if($data['id'] == 0){
                $data['time_hot_main'] = intval(ceil($data['time_hot_main'] ? $data['release_time'] + $data['time_hot_main']*3600 : $data['release_time'] + 86400*2)) ;
            }else {
                $data['time_hot_main'] = intval(ceil($data['release_time'] + $data['time_hot_main']*3600));
            }

        }

        if(!isset($data['hot_item'])) {
            $data['hot_item'] = 0;
            $data['time_hot_item'] = 0;
        }
        else {
            $data['order_item'] = 1;
            if($data['id'] == 0){
                $data['time_hot_item'] = intval(ceil($data['time_hot_item'] ? $data['release_time'] + $data['time_hot_item']*3600 : $data['release_time'] + 86400*2));
            }else {
                $data['time_hot_item'] = intval(ceil($data['release_time'] + $data['time_hot_item']*3600));
            }
        }

//        dd($data);

        // Start transaction
        DB::beginTransaction();
        $check = 1;

        if($data['id'] == 0){ //Tạo mới bài viết
            $data['created_at'] = time();

            $articel = News::create($data);
            $image = $request->file('img');
            // // dd($request);
            // if ($request->hasFile('img')) {
            //     // dd($image);
            //     $articel->fimage = saveImageArticle([$image], 'article');
            // }
            // $articel->save();

            if(!$articel->id) $check = 0;

            $data_group_news = [];

            if(count($group_id)){
                foreach ($group_id as $val){
                    if($data['hot_item'] == 1){
                        $item = [
                            'group_vn_id' => $val,
                            'news_vn_id' => (string)$articel->id,
                            'hot' => 1
                        ];
                    }else{
                        $item = [
                            'group_vn_id' => $val,
                            'news_vn_id' => (string)$articel->id,
                            'hot' => 0
                        ];
                    }
                    $data_group_news[] = $item;
                }
            }
            if(count($data_group_news)){
                if(!DB::table($this->db->group_news)->insert($data_group_news)) $check = 0;

            }
            $articel->content = $content;
            if(!$this->add_log($articel,$status,"Tạo mới,".$status_str)) $check = 0;
            if($check == 1){
                DB::commit();
                return redirect()->route('admin_articel')->with('status','Tạo mới thành công');
            }else {
                DB::rollBack();
                $data['content'] = $content;
                $date = $data['release_time'];
                unset($data['release_time']);
                $data['release_time']['day'] = date('Y-m-d',$date);
                $data['release_time']['h'] = date('h:i A',$date);
                $data['groupid'] = $group_id;
                return redirect()->route('form_articel',0)->with('error','Tạo mới không thành công')->with('articel',((object)$data));
            }
        }else { //Cập nhật bài viết
            $articel = News::find($data['id']);

            if(!$articel){
                return redirect()->route('admin_articel')->with('error','Có lỗi xảy ra');
            }else {
                $data['updated_at'] = time();


                
                if(!$articel->update($data)){$check = 0;}

                if(DB::table($this->db->group_news)->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

                $data_group_news = [];

                if(count($group_id)){
                    foreach ($group_id as $val){
                        if($data['hot_item'] == 1){
                            $item = [
                                'group_vn_id' => $val,
                                'news_vn_id' => (string)$articel->id,
                                'hot' => 1
                            ];
                        }else{
                            $item = [
                                'group_vn_id' => $val,
                                'news_vn_id' => (string)$articel->id,
                                'hot' => 0
                            ];
                        }

                        $data_group_news[] = $item;
                    }
                }

                if(count($data_group_news)){
                    if(!DB::table($this->db->group_news)->insert($data_group_news)){$check = 0;}
                }

                $articel->content = $content;
                if(!$this->add_log($articel,$status,'Chỉnh sửa'.$status_str)) $check = 0;
                if($check == 1){
                    DB::commit();
                    return redirect()->route('admin_articel')->with('success','Cập nhật thành công');
                }else {
                    DB::rollBack();
                    $data['content'] = $content;
                    $date = $data['release_time'];
                    unset($data['release_time']);
                    $data['release_time']['day'] = date('Y-m-d',$date);
                    $data['release_time']['h'] = date('h:i A',$date);
                    $data['groupid'] = $group_id;
                    return redirect()->route('form_articel',$articel->id)->with('error','Cập nhật không thành công')->with('articel',$data);
                }
            }
        }
    }

    public function delete_articel($id){
        $articel = News::find($id);
        DB::beginTransaction();
        $check = 1;

        if(DB::table($this->db->logfile)->where('LogId',$id)->delete() <= 0) $check = 0;

        if(DB::table($this->db->group_news)->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

        if(!$articel->delete()) $check = 0;

        if($check == 1){
            DB::commit();
            return redirect()->route('admin_articel')->with('status','Xóa thành công');
        }else {
            DB::rollBack();
            return redirect()->route('admin_articel')->with('error','Xóa không thành công');
        }

    }

    public function add_log($articel,$status,$status_str){
        $user_login = Auth::user();
        $log_data = [
            'LogId' => $articel->id,
            'userId' => $user_login->id,
            'created_at' => time(),
            'noidung' => $articel->content,
            'groupid' => $articel->groupid,
            'title' => $articel->title,
            'TrangthaiID' => $status,
            'GhiChu' => $status_str
        ];

        if(LogFile_vn::create($log_data)){
            return true;
        }else return false;
    }

    public function history_articel($id){
        $log = DB::table($this->db->logfile)->where('LogId',$id)->paginate(8);
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
        $log = DB::table($this->db->logfile)->find($id);
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
        $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'Trang chủ'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        $arrticel_hot = DB::table($this->db->news)->where('hot_main',1)->where('status',1)->where('time_hot_main' ,'>=', time())->orderBy('order_main')->orderBy('release_time','desc')->get();

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
        $list_group = DB::table($this->db->group)->where('status', 1)->where('type','!=',1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'Trang chủ'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        if($group_id == 0){
            $arrticel_hot = DB::table($this->db->news)->where('hot_main',1)->orderBy('order_main')->get();
        }else {
            $list_group = DB::table($this->db->group)->where('status',1)->get();
            $result_1[] = $group_id;

            $this->recusive_find_child($list_group,$group_id,$result_1);

            $result_1 = array_unique($result_1);

            $articel_hot_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$result_1)->where('hot',1)->get(['news_vn_id'])->toJson();

            $articel_hot_ids = array_column(json_decode($articel_hot_ids,true),'news_vn_id');

            $arrticel_hot = DB::table($this->db->news)->where('status',1)->where('time_hot_item','>=',time())->whereIn('id',$articel_hot_ids)->orderBy('order_item')->orderBy('release_time','desc')->get();
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
        if($data['groupid'] == 0){
            unset($data['groupid']);
            foreach ($data as $key => $val){
                DB::table($this->db->news)->where('id',$key)->update(['order_main' => $val]);
            }
        }else {
            unset($data['groupid']);
            foreach ($data as $key => $val){
                DB::table($this->db->news)->where('id',$key)->update(['order_item' => $val]);
            }
        }
        return redirect()->route('sort_hot_articel' )->with('success','Sắp xếp thành công');
    }

    public function delete_articel_hot($groupid,$id){
        if($groupid == 0){
            if(DB::table($this->db->news)->where('id',$id)->update(['hot_main' => 0])){
                return redirect()->route('sort_hot_articel' )->with('success','Xóa thành công');
            }else return redirect()->route('sort_hot_articel' )->with('error','Xóa không thành công');
        }else {
            if(DB::table($this->db->group_news)->where('news_vn_id',$id)->update(['hot' => 0]) || DB::table($this->db->news)->where('id',$id)->update(['hot_item' => 0])){
                return redirect()->route('sort_hot_articel' )->with('success','Xóa thành công');
            }else return redirect()->route('sort_hot_articel' )->with('error','Xóa không thành công');
        }
    }

    function get_status(){
        $user = Auth::user();
        $status = 4;
        $status_str = 'Gửi bài biên tập';
        switch ($user->level){
            case 1: $status = 1;$status_str = "đăng ngay";break;
            case 2: $status = 1;$status_str = "đăng ngay"; break;
            case 3: $status = 2;$status_str = "chờ duyệt lần 2"; break;
            case 4: $status = 3;$status_str = "chờ duyệt lần 1"; break;
        }
        return [
            'status' => $status,
            'status_str' => $status_str
        ];
    }

    function update_status($id,Request $request){
        $str = "";
        $status = $request->get('status');

        switch ($status){
            case 1 : $str = "Đăng bài";break;
            case 0 : $str = "Tắt bài";break;
            case 4 : $str = "Trả lại";break;
            case 3 : $str = "Duyệt lần 1";break;
            case 2 : $str = "Duyệt lần 2";break;
        }
        $articel = News::find($id);
        if($articel->update(['status' => $status]) && $this->add_log($articel,$status,$str)){
            Session::put(['success' => 'Cập nhật thành công']);
            return json_encode([
                'status' => 1
            ]);
        }else{
            Session::put(['error' => 'Cập nhật không thành công']);
            return json_encode([
                'status' => 0
            ]);
        }
    }


    public function getOn(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 0 || $news->status == 2) {
            $news->status = 1;
        }
        else{
            return response('error', 200);
        }
        $news->save();
        return response('success', 200);
    }
    public function getOff(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 1) {
            $news->status = 0;
        }
        else{
            return response('error', 200);
        }
        $news->save();
        return response('success', 200);
    }

    public function get2(){

        $id = Input::get('id');
        $news = News::find($id);

        if ($news->status == 1 || $news->status == 3) {
            $news->status = 2;
        }
        else{
            return response('error', 200);
        }
        $news->save();
        return response('success', 200);
    }
    public function get3(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 2 || $news->status == 4) {
            $news->status = 3;
        }
        else{
            return response('error', 200);
        }
        $news->save();
        return response('success', 200);
    }
    public function get4(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 2 || $news->status == 3) {
            $news->status = 4;
        }
        else{
            return response('error', 200);
        }
        $news->save();
        return response('success', 200);
    }


}
