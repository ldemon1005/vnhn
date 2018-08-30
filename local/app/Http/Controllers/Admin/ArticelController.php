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
    public function fix_bug (Request $request){
        

    }
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
                $status = [0,1];
                break;
            case 2:
                $status = [0,1];
                break;
            case 3:
                $status = [0,1,2,3];
                break;
            case 4:
                $status = [0,1,2,3,4];
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
        $site = isset($paramater['site']) ? $paramater['site'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            if (isset($paramater['status']) && Auth::user()->level == 4 && in_array(2, $status)) {
                $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('status', 2)
                      ->orWhere('status', 3);
                });
            }
            else{
                $list_articel = $list_articel->whereIn('status',$status);
            }
            
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
        if (Auth::user()->level < 3 && Auth::user()->site == 1) {
            if(count($site)){
                $list_acc_ids = Account::whereIn('site', $site)->get(['id'])->toArray();
                $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
            }
        }
        else{
            $site = [Auth::user()->site];
            $list_acc_ids = Account::whereIn('site', $site )->get(['id'])->toArray();
            $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
        }

        if (Auth::user()->level > 2) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }

        $list_articel = $list_articel->paginate(10);

        // foreach ($list_articel as $item) {
        //     // dd($item->summary);

        //     $str = substr($item->summary,0,4);
        //     // dd($str);
        //     if ($str != 'VNHN') {
                
        //         $art = News::find($item->id);
        //         $art->summary = 'VNHNO - '.$item->summary;
        //         $art->save();
        //     }
        // }

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
            if ($val->userid != null) {
                $val->author = Account::find($val->userid); 
                if ($val->author != null) {
                    $val->author = $val->author->username;
                }
                $val->author_date = $val->created_at;
            }
            $date = $val->release_time;
            unset($val->release_time);
            // $val->release_time->day = date('Y-m-d',$date);
            // $val->release_time->h = date('h:i A',$date);
            $val->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
            
            if ($val->approved_id != null) {
                $val->approved = Account::find($val->approved_id)->username; 
                $val->approved_date = date('d/m/Y H:m', $val->approved_at);
            }
            else{
                $val->approved = null;
            }

            $group_id_new = explode(',',$val->groupid);
            foreach ($group_id_new as $id) {
                $group = DB::table($this->db->group)->where('id', $id)->first();
                if ($group!= null && $group->parentid != 0) {
                    $parent = DB::table($this->db->group)->where('id', $id)->first();
                }
            }
                
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
        
        return view('admin.articel.index', $data);
            
    }

    public function approved(Request $request){
        
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
                $status = [2,3];
                break;
            case 2:
                $status = [2];
                break;
            case 3:
                $status = [3];
                break;
            case 4:
                $status = [];
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
        if (Auth::user()->level == 1) {
            $status = isset($paramater['status']) ? $paramater['status'] : $status;
        }
        
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        $site = isset($paramater['site']) ? $paramater['site'] : [];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');
        $return_num = isset($paramater['return_num']) ? $paramater['return_num'] : [];

        
        if (Auth::user()->level < 3 && Auth::user()->site == 1) {
            if(count($site)){
                $list_acc_ids = Account::whereIn('site', $site)->get(['id'])->toArray();
                $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
            }
        }
        else{
            $site = [Auth::user()->site];
            $list_acc_ids = Account::whereIn('site', $site )->get(['id'])->toArray();
            $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
        }
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
        }
        if (Auth::user()->level > 3) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }
        else{
            $list_articel =  $list_articel->whereNotIn('userid', [Auth::user()->id]);
        }
        if (count($return_num)) {
            if (in_array(0,$return_num)) {
                $list_articel =  $list_articel->whereIn('return_num', $return_num);
            }
            else{
                $list_articel =  $list_articel->where('return_num', '>', 0);
            }
            
        }


        
        $list_articel = $list_articel->paginate(10);
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
        if(isset($paramater_return['site'])){
            $list_articel->appends(['site' => $paramater_return['site']]);
        }
        if(isset($paramater_return['return_num'])){
            $list_articel->appends(['return_num' => $paramater_return['return_num']]);
        }



        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
            if ($val->userid != null) {
                $val->author = Account::find($val->userid); 
                if ($val->author != null) {
                    $val->author = $val->author->username;
                }
                $val->author_date = $val->created_at;
            }
            
            
            if ($val->approved_id != null) {
                $val->approved = Account::find($val->approved_id)->username; 
                $val->approved_date = date('d/m/Y H:m', $val->approved_at);
            }
            else{
                $val->approved = null;
            }
            $date = $val->release_time;
            unset($val->release_time);
            // $val->release_time->day = date('Y-m-d',$date);
            // $val->release_time->h = date('h:i A',$date);
            $val->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
            

            $group_id_new = explode(',',$val->groupid);
            foreach ($group_id_new as $id) {
                $group = DB::table($this->db->group)->where('id', $id)->first();
                if ($group!= null && $group->parentid != 0) {
                    $parent = DB::table($this->db->group)->where('id', $id)->first();
                }
            }
                
        }
        
        if(!$paramater){
            $paramater = [
                'key_search' => '',
                'group_id' => [],
                'status' => [],
                'site' => []
            ];
        }

        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'paramater' => $paramater,
        ];

        
        return view('admin.articel.approved', $data);
    }

    public function approved_cgroup(Request $request){
        
        
        $user = Auth::user();
        $group_ids = explode(',',$user->group_id);
        $list_group = DB::table($this->db->group)->where('status', 1)->get()->toArray();
        // if($user->group_id == '0'){
            
        // }else {
        //     $list_group = DB::table($this->db->group)->where('status', 1)->where(function ($query) use ($group_ids){
        //         $query->whereIn('id',$group_ids)
        //               ->orWhereIn('parentid',$group_ids);
        //     })->get()->toArray();
        // }
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
                $status = [2,3];
                break;
            case 2:
                $status = [2];
                break;
            case 3:
                $status = [3];
                break;
            case 4:
                $status = [];
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
        if (Auth::user()->level == 1) {
            $status = isset($paramater['status']) ? $paramater['status'] : $status;
        }
        
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        // $site = isset($paramater['site']) ? $paramater['site'] : [];
        $site = [1];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        
        if (Auth::user()->level < 3) {
            if(count($site)){
                $list_acc_ids = Account::whereIn('site', $site)->get(['id'])->toArray();
                $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
            }
        }
        else{
            $site = [Auth::user()->site];
            $list_acc_ids = Account::whereIn('site', $site )->get(['id'])->toArray();
            $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
        }
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
        }
        if (Auth::user()->level > 3) {
            $list_articel =  $list_articel->where('userid', Auth::user()->id);
        }
        else{
            $list_articel =  $list_articel->whereNotIn('userid', [Auth::user()->id]);
        }
        
        $list_articel = $list_articel->where('return_num', '==', 0)->paginate(10);
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
        if(isset($paramater_return['site'])){
            $list_articel->appends(['site' => $paramater_return['site']]);
        }



        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
            if ($val->userid != null) {
                $val->author = Account::find($val->userid); 
                if ($val->author != null) {
                    $val->author = $val->author->username;
                }
                $val->author_date = $val->created_at;
            }
            
            
            if ($val->approved_id != null) {
                $val->approved = Account::find($val->approved_id)->username; 
                $val->approved_date = date('d/m/Y H:m', $val->approved_at);
            }
            else{
                $val->approved = null;
            }

             $date = $val->release_time;
            unset($val->release_time);
            // $val->release_time->day = date('Y-m-d',$date);
            // $val->release_time->h = date('h:i A',$date);
            $val->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
            
            $group_id_new = explode(',',$val->groupid);
            foreach ($group_id_new as $id) {
                $group = DB::table($this->db->group)->where('id', $id)->first();
                if ($group!= null && $group->parentid != 0) {
                    $parent = DB::table($this->db->group)->where('id', $id)->first();
                }
            }
                
        }
        
        if(!$paramater){
            $paramater = [
                'key_search' => '',
                'group_id' => [],
                'status' => [],
                'site' => []
            ];
        }

        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'paramater' => $paramater,
        ];

        
        return view('admin.articel.approved', $data);
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
        $article_relate = [];
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
                'relate' => '',
                'release_time' => (object)[
                    'day' => date('Y-m-d',time()),
                    'h' => date('h:i A',time())
                ],
                'hot_main' => 0,
                'time_hot_main' => 0,
                'hot_item' => 0,
                'time_hot_item' => 0,
                'hot_tiny' => 0,
                'time_hot_tiny' => 0,
                'loaitinbai' => 0
            ];
            $articel = (object)$data;
        }else{

            $articel = DB::table($this->db->news)->find($id);
            $article = News::find($id);
            if ($article->time_hot_item - time() <= 0) {
                $article->hot_item =  0;
                
            }
            if ($article->time_hot_main - time() <= 0) {
                $article->hot_main =  0;
                
            }
            if ($article->time_hot_tiny - time() <= 0) {
                $article->hot_tiny =  0;
                
            }
            $article->save();
            if ($user->level == 4 && $articel->userid != $user->id) {
                return redirect('admin');
            }
            if($user->level == 4 && $articel->status == 1){
                return redirect('admin');
            }
            $articel->groupid = explode(',',$articel->groupid);
            $articel->relate = explode(',',$articel->relate);
            $article_relate = DB::table($this->db->news)->whereIn('groupid', $articel->groupid)->get();
            $content = DB::table($this->db->logfile)->orderByDesc('id')->where('noidung', '!=' , null)->where('LogId',$articel->id)->first();
            $articel->content = $content ? $content->noidung : '';

            // dd($data);
            
            $articel->time_hot_item = round($articel->time_hot_item - time() > 0? ($articel->time_hot_item - time())/3600 : 0 );
            $articel->time_hot_main = round($articel->time_hot_main - time() > 0? ($articel->time_hot_main - time())/3600 : 0 );
            $articel->time_hot_tiny = round($articel->time_hot_tiny - time() > 0? ($articel->time_hot_tiny - time())/3600 : 0 );
            $date = $articel->release_time;

            $articel->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
        }

        $data = [
            'articel' => $articel,
            'list_group' => $result,
            'article_relate' => $article_relate
        ];

        return view('admin.articel.form_articel',$data);
    }

    public function action_articel(Request $request){
        $data = $request->get('articel');
        // dd($data);
        $data['release_time'] = strtotime($data['release_time']['day'].' '.$data['release_time']['h']);

        // $status = $this->get_status()['status'];
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
        
        $status_str = $this->get_status()['status_str'];
        
        $group_id = $data['groupid'];

        $content = $data['content'];
        unset($data['content']);
        $data['groupid'] = join(',',$data['groupid']);
        if (isset($data['relate']) &&$data['relate'] != null) {
           $data['relate'] = join(',',$data['relate']);
        }
        


        

        $data['updated_at'] = time();
        $data['slug'] = str_slug($data['title']);
        
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $data['fimage'] = saveImageArticle([$image], 'article');
        }


        
        // dd($data);

        // Start transaction
        DB::beginTransaction();
        $check = 1;

        if($data['id'] == 0){ //Tạo mới bài viết
            unset($data['send']);

            if(!isset($data['hot_main'])) {
                $data['hot_main'] = 0;
                $data['time_hot_main'] = 0;
            }
            else {
                $data['order_main'] = 1;
                $data['time_hot_main'] = round($data['time_hot_main'] ? $data['release_time'] + $data['time_hot_main']*3600 : $data['release_time'] + 86400*2);
            }

            if(!isset($data['hot_item'])) {
                $data['hot_item'] = 0;
                $data['time_hot_item'] = 0;
            }
            else {
                $data['order_item'] = 1;
                $data['time_hot_item'] = round($data['time_hot_item'] ? $data['release_time'] + $data['time_hot_item']*3600 : $data['release_time'] + 86400*2);
            }

            if(!isset($data['hot_tiny'])) {
                $data['hot_tiny'] = 0;
                $data['time_hot_tiny'] = 0;
            }
            else {
                $data['order_item'] = 1;
                $data['time_hot_tiny'] = round($data['time_hot_tiny'] ? $data['release_time'] + $data['time_hot_tiny']*3600 : $data['release_time'] + 86400*2);
            }


            $data['status'] = $status;
            $data['created_at'] = time();
            
            $user_login = Auth::user();
            $data['userid'] = $user_login->id;
            if (Auth::user()->level < 4) {
                $data['approved_id'] = $user_login->id;
                $data['approved_at'] = $data['created_at'];
            }

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
                    if($data['hot_item'] == 1 || $data['hot_tiny'] == 1){
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

            if(!isset($data['hot_main'])) {
                $data['hot_main'] = 0;
                $data['time_hot_main'] = 0;
            }
            else {
                $data['order_main'] = 1;
                $data['time_hot_main'] = round($data['time_hot_main'] ? time() + $data['time_hot_main']*3600 : $data['release_time'] + 86400*2);
            }

            if(!isset($data['hot_item'])) {
                $data['hot_item'] = 0;
                $data['time_hot_item'] = 0;
            }
            else {
                $data['order_item'] = 1;
                $data['time_hot_item'] = round($data['time_hot_item'] ? time() + $data['time_hot_item']*3600 : $data['release_time'] + 86400*2);
            }

            if(!isset($data['hot_tiny'])) {
                $data['hot_tiny'] = 0;
                $data['time_hot_tiny'] = 0;
            }
            else {
                $data['order_item'] = 1;
                $data['time_hot_tiny'] = round($data['time_hot_tiny'] ? time() + $data['time_hot_tiny']*3600 : $data['release_time'] + 86400*2);
            }

            if(!$articel){
                return redirect()->route('admin_articel')->with('error','Có lỗi xảy ra');
            }else {
                $data['updated_at'] = time();
                $user_login = Auth::user();
                if (Auth::user()->level < 4) {
                    $data['approved_id'] = $user_login->id;
                    $data['approved_at'] = $data['updated_at'];
                }
                $send  = $data['send'];
                if ($data['send'] != null) {
                    $data['status'] = $articel->status - 1;
                }
                // dd($send);
                unset($data['send']);
                
                if(!$articel->update($data)){$check = 0;}

                if(DB::table($this->db->group_news)->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

                $data_group_news = [];

                if(count($group_id)){
                    foreach ($group_id as $val){
                        if($data['hot_item'] == 1 || $data['hot_tiny'] == 1){
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
                if ($send == '1') {
                    if(!$this->add_log($articel,$status,'Gửi lại ,'.$status_str)) $check = 0;
                }
                else{
                    if(!$this->add_log($articel,$status,'Chỉnh sửa,'.$status_str)) $check = 0;
                }
                
                if($check == 1){
                    DB::commit();
                    if ($send == '1') {
                        return back()->with('success','Gửi lại thành công');
                    }
                    else{
                        return back()->with('success','Cập nhật thành công');
                    }
                    
                    
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

    public function post_article(Request $request){
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
                $status = [0,1];
                break;
            case 2:
                $status = [0,1];
                break;
            case 3:
                $status = [0,1];
                break;
            case 4:
                $status = [0,1];
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
        $site = isset($paramater['site']) ? $paramater['site'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            if (isset($paramater['status']) && Auth::user()->level == 4 && in_array(2, $status)) {
                $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('status', 2)
                      ->orWhere('status', 3);
                });
            }
            else{
                $list_articel = $list_articel->whereIn('status',$status);
            }
            
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

            $list_acc_ids = Account::where('site', $user->site)->where('level', '>', $user->level)->get(['id'])->toArray();
            $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
        
      

        $list_articel = $list_articel->paginate(10);

        
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
            if ($val->userid != null) {
                $val->author = Account::find($val->userid); 
                if ($val->author != null) {
                    $val->author = $val->author->username;
                }
                $val->author_date = $val->created_at;
            }
            $date = $val->release_time;
            unset($val->release_time);
            // $val->release_time->day = date('Y-m-d',$date);
            // $val->release_time->h = date('h:i A',$date);
            $val->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
            
            if ($val->approved_id != null) {
                $val->approved = Account::find($val->approved_id)->username; 
                $val->approved_date = date('d/m/Y H:m', $val->approved_at);
            }
            else{
                $val->approved = null;
            }

            $group_id_new = explode(',',$val->groupid);
            foreach ($group_id_new as $id) {
                $group = DB::table($this->db->group)->where('id', $id)->first();
                if ($group!= null && $group->parentid != 0) {
                    $parent = DB::table($this->db->group)->where('id', $id)->first();
                }
            }
                
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
        
        return view('admin.articel.index', $data);
    }

    public function returned_article(Request $request){
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
        $status = [4];
        
        $paramater = $request->all();

        if (isset($paramater['articel'])){
            $paramater = $paramater['articel'];
        }

        $paramater_return = $paramater;



        $group_id = isset($paramater['group_id']) ? $paramater['group_id'] : $group_ids;
        $status = isset($paramater['status']) ? $paramater['status'] : $status;
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];
        $site = isset($paramater['site']) ? $paramater['site'] : [];
        // $group_id = [1455];
        $list_articel = DB::table($this->db->news)->orderByDesc('id');

        if(count($status)){
            if (isset($paramater['status']) && Auth::user()->level == 4 && in_array(2, $status)) {
                $list_articel = $list_articel->where(function ($query) use ($key_search){
                $query->where('status', 2)
                      ->orWhere('status', 3);
                });
            }
            else{
                $list_articel = $list_articel->whereIn('status',$status);
            }
            
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

            $list_acc_ids = Account::where('site', $user->site)->where('level', '>', $user->level)->get(['id'])->toArray();
            $list_articel = $list_articel->whereIn('userid',$list_acc_ids);
        
      

        $list_articel = $list_articel->paginate(10);

        
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
            if ($val->userid != null) {
                $val->author = Account::find($val->userid); 
                if ($val->author != null) {
                    $val->author = $val->author->username;
                }
                $val->author_date = $val->created_at;
            }
            $date = $val->release_time;
            unset($val->release_time);
            // $val->release_time->day = date('Y-m-d',$date);
            // $val->release_time->h = date('h:i A',$date);
            $val->release_time = (object)[
                'day' => date('Y-m-d',$date),
                'h' => date('h:i A',$date)
            ];
            
            if ($val->approved_id != null) {
                $val->approved = Account::find($val->approved_id)->username; 
                $val->approved_date = date('d/m/Y H:m', $val->approved_at);
            }
            else{
                $val->approved = null;
            }

            $group_id_new = explode(',',$val->groupid);
            foreach ($group_id_new as $id) {
                $group = DB::table($this->db->group)->where('id', $id)->first();
                if ($group!= null && $group->parentid != 0) {
                    $parent = DB::table($this->db->group)->where('id', $id)->first();
                }
            }
                
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
        
        return view('admin.articel.index', $data);
    }

    
    public function delete_articel($id){
        $articel = News::find($id);
        if (!isset($articel)) {
            return back()->with('error','Xóa bị lỗi');
        }
        if ($articel->status == 1) {
            return redirect('admin');
        }
        // dd($articel->userid);

        if (Auth::user()->level == 4 && (int) $articel->userid != (int) Auth::user()->id) {
            return redirect('admin');
        }
        DB::beginTransaction();
        $check = 1;

        if(DB::table($this->db->logfile)->where('LogId',$id)->delete() <= 0) $check = 0;

        if(DB::table($this->db->group_news)->where('news_vn_id',$articel->id)->delete() <=0) {$check = 0;}

        if(!$articel->delete()) $check = 0;

        if($check == 1){
            DB::commit();
            return back()->with('success','Xóa thành công');
        }else {
            DB::rollBack();
            return back()->with('error','Xóa không thành công');
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
        $log = DB::table($this->db->logfile)->where('LogId',$id)->get();
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
        $article = DB::table($this->db->news)->find($log->LogId);
        $this->get_time($article);

        if ($log->noidung == null) {
            $log = DB::table($this->db->logfile)->where('LogId', $article->id)->where('noidung', '!=' , null)->orderBy('ID','desc')->first();
        }

        if ($article->relate != null) {
            $relate_id = explode(',',$article->relate);
            $relates = DB::table($this->db->news)->whereIn('id',$relate_id)->get();
        }
        else{
            $relates = null;
        }

        $data = [
            'log' => $log,
            'relates' => $relates,
            'article' => $article
        ];
        
        return view('admin.articel.view_articel', $data);
    }
    function view_log_now($id_new){
        $article = DB::table($this->db->news)->find($id_new);

        $log = DB::table($this->db->logfile)->where('LogId', $article->id)->where('noidung', '!=' , null)->orderBy('ID','desc')->first();
        
        if ($article->relate != null) {
            $relate_id = explode(',',$article->relate);
            $relates = DB::table($this->db->news)->whereIn('id',$relate_id)->get();
        }
        else{
            $relates = null;
        }
        $this->get_time($article);
        $data = [
            'log' => $log,
            'relates' => $relates,
            'article' => $article
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
            $articel_hot_ids = DB::table($this->db->group_news)->where('group_vn_id',$group_id)->where('hot',1)->get(['news_vn_id'])->toJson();

            $articel_hot_ids = array_column(json_decode($articel_hot_ids,true),'news_vn_id');

            $arrticel_hot = DB::table($this->db->news)->where('status',1)->where(function ($query) {
                $query->where('time_hot_item','>=',time())
                      ->orWhere('time_hot_tiny','>=',time());
            })->whereIn('id',$articel_hot_ids)->orderBy('order_item')->orderBy('release_time','desc')->get();
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



    public function  get_relate(){
        $group_id = Input::get('groupid');
        // $group_id = explode(',',$group_id);

        
        $list_article = DB::table($this->db->news)->whereIn('groupid',$group_id)->get();

        $data = [
            'list_article' => $list_article
        ];

        $view = View::make('admin.articel.relate',$data)->render();
        return response($view, 200);
        // // return json_encode([
        // //     'content' => $group_id
        // // ]);
        // return json_encode([
        //     'content' => $view
        // ]);
    }

    public function getOn(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 0 || $news->status == 2) {
            if(!$this->add_log($news, 1,'Đăng lên')) return response('error', 502);
            $user_login = Auth::user();
            $data['approved_id'] = $user_login->id;
            $data['approved_at'] = time();
            if(!$news->update($data))return response('error', 503);
            $news->status = 1;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }
    public function getOff(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 1) {
            if(!$this->add_log($news, 0,'Gỡ xuống')) return response('error', 502);
            $news->status = 0;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }

    public function get1(){

        $id = Input::get('id');
        $news = News::find($id);

        if ($news->status == 2 || $news->status == 0) {
            if(!$this->add_log($news, 1,'Phó tổng duyệt - đăng lên')) return response('error', 502);
            $user_login = Auth::user();
            $data['approved_id'] = $user_login->id;
            $data['approved_at'] = time();
            if ($news->release_time < time()) {
                $data['release_time'] = time();
            }
            if(!$news->update($data))return response('error', 503);
            $news->status = 1;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }

    public function get2(){

        $id = Input::get('id');
        $news = News::find($id);

        if ($news->status == 1 || $news->status == 3) {
            if(!$this->add_log($news, 2,'Biên tập viên duyệt')) return response('error', 502);
            $user_login = Auth::user();
            $data['approved_id'] = $user_login->id;
            $data['approved_at'] = time();
            if(!$news->update($data))return response('error', 503);
            $news->status = 2;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }
    public function get3(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 2 || $news->status == 4) {
            if(!$this->add_log($news, 3,'Gửi lại')) return response('error', 502);
            $news->status = 3;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }
    public function get4(){
        $id = Input::get('id');
        $news = News::find($id);
        if ($news->status == 2 || $news->status == 3) {
            if(!$this->add_log($news, 4,'Trả lại')) return response('error', 502);
            $news->status = 4;
        }
        else{
            return response('error', 501);
        }
        $news->save();
        return response('success', 200);
    }



    public function getReturn(Request $request){
        $id = $request->id_article;
        $comment = $request->messages;
        // dd($comment);
        $news = News::find($id);
        $status = Account::find($news->userid)->level;
        if ($news->status == 2 || $news->status == 3) {
            if(!$this->add_log_mess($news, 4,'Trả lại', $comment )) return back()->with('error', 'Lỗi trả lại (Không lưu đưuọc lịch sử)');
            $news->status = $status;
            if(Auth::user()->level < 3){
                $news->return_num ++ ;
            }
        }
        else{
            return back()->with('error', 'Lỗi !! Bài viết gặp lỗi');
        }
        $news->save();
        // $log = LogFile_vn::where('LogId', $news->id)->get();
        // dd($log);

        return back()->with('success', 'Trả lại thành công');
    }


    public function add_log_mess($articel,$status,$status_str,$comment){
        $user_login = Auth::user();
        $log_data = [
            'LogId' => $articel->id,
            'userId' => $user_login->id,
            'created_at' => time(),
            'noidung' => $articel->content,
            'groupid' => $articel->groupid,
            'title' => $articel->title,
            'TrangthaiID' => $status,
            'GhiChu' => $status_str,
            'comment' => $comment
        ];
        // dd($log_data);

        if(LogFile_vn::create($log_data)){
            return true;
        }else return false;
    }


    public function getComment(){
        $id = Input::get('id');
        $news = News::find($id);
        $user_login = Auth::user();
        $log = LogFile_vn::where('LogId', $id)->orderByDesc('created_at')->first();
        return response($log->comment, 200);
    }

    public function set_time(){
        DB::beginTransaction();
        $check = 1;

        $id = Input::get('id');
        $day = Input::get('day');
        $h = Input::get('h');

        $data['release_time'] = strtotime($day.' '.$h);

        $article = News::find($id);
        if(!$article->update($data)){$check = 0;}
        if(!$this->add_log($article, $article->status,'Sửa thời gian')) $check = 0;
        if($check == 1){
            DB::commit();
            $release_time = [
                'day' => date('Y-m-d',$article->release_time),
                'h' => date('h:i A',$article->release_time)
            ];
            return response()->json($release_time);
        }else {
            DB::rollBack();
            return response('error', 501);
        }
    }
}
