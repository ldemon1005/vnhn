<?php

namespace App\Http\Controllers\Client;

use App\Model\News;
use App\Models\Comment_vn;
use App\Models\AdvertTop;
use App\Models\Advert;
use App\Models\MagazineNew;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ArticelController extends Controller
{
    public function get_detail($slug){
        $slug = explode('---n-',$slug);

        $articel = News::find($slug[1]);

        if (!$articel) {
            Session::put('lang', 'en');

            $articel = News::find($slug[1]);
            if (!$articel) {
                return redirect('');
            }
            return header("Refresh:0");
        }
        else{
            if($articel->release_time > time()){
                return redirect('');
            }
        }
        
        
        if ($articel->relate != null) {
            $relate_id = explode(',',$articel->relate);
            $relates = DB::table($this->db->news)->whereIn('id',$relate_id)->where('release_time','<=',time())->get();
        }
        else{
            $relates = null;
        }
        if($articel){
            if($articel->status != 1){
                return redirect()->route('home');
            }
        }else {
            return redirect()->route('home');
        }

        // $articel->update(['ncount' => $articel-> + 1ncount]);

        $content = DB::table($this->db->logfile)->where('LogId',$slug[1])->whereNotNull('noidung')->where('noidung','!=','')
            ->orderByDesc
            ('id')->first();

        $group_id = DB::table($this->db->group_news)->where('news_vn_id',$articel->id)->get()->toJson();

        $group_id = array_column(json_decode($group_id,true),'group_vn_id') ;

        $group_0 = DB::table($this->db->group)->whereIn('id',$group_id)->orderByDesc('parentid')->first();

        $group_id = $group_0->id;

        $parent_id = $group_0->parentid;

        $groups = DB::table($this->db->group)->where('status',1)->get();

        $result = [];
        $group_related = $group_id;

        $this->recusive_menu_parent($groups,$group_id,$result,$group_related);

        $list_group_related[] = $group_related;
        $this->recusive_find_child($groups,$group_related,$list_group_related);

        $list_article_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$list_group_related)->get()->toJson();

        $list_article_ids = array_column(json_decode($list_article_ids,true),'news_vn_id') ;

        if(count($result)){
            $result = array_unique($result);

            $list_article_ids = array_unique($list_article_ids);
        }


        $list_group = DB::table($this->db->group)->where('status',1)->whereIn('id',$result)->orderBy('parentid')->get();

        $articel_related = DB::table($this->db->news)->whereIn('id',$list_article_ids)->where('status',1)->where('release_time','<=',time())->orderBy('order_item')
            ->orderByDesc('release_time')->take(8)->get();

        foreach ($articel_related as $item){
            $this->get_time($item);
        }

        $articel_related_3 = $articel_related->slice(0,3);
        $articel_related_5 = $articel_related->slice(3,5);

        $articel->content = $content ? $content->noidung : '';

        $day_in_week = date('N',$articel->release_time);

        $articel->release_time = date('d/m/Y H:m',$articel->release_time);

        $day_in_week_str = '';


        if(Session::get('lang','vn') == 'vn'){
            switch ($day_in_week){
                case 1 : $day_in_week_str = 'Thứ 2';break;
                case 2 : $day_in_week_str = 'Thứ 3';break;
                case 3 : $day_in_week_str = 'Thứ 4';break;
                case 4 : $day_in_week_str = 'Thứ 5';break;
                case 5 : $day_in_week_str = 'Thứ 6';break;
                case 6 : $day_in_week_str = 'Thứ 7';break;
                case 7 : $day_in_week_str = 'Chủ nhật';break;
            }
        }else {
            switch ($day_in_week){
                case 1 : $day_in_week_str = 'Monday';break;
                case 2 : $day_in_week_str = 'Tuesday';break;
                case 3 : $day_in_week_str = 'Wednesday';break;
                case 4 : $day_in_week_str = 'Thursday';break;
                case 5 : $day_in_week_str = 'Friday';break;
                case 6 : $day_in_week_str = 'Saturday';break;
                case 7 : $day_in_week_str = 'Sunday';break;
            }
        }


        $articel->day_in_week_str = $day_in_week_str;


        /*
         *  articel top view
         */

        $articel_top_view = $this->articel_top_view($list_article_ids);

        /*
         * magazine
         */
        // $magazine_new = $this->get_magazine_new();
        $magazine_new = MagazineNew::where('m_status', 1)->orderBy('m_hot', 'asc')->get();


        // advert
        $advert = app('App\Http\Controllers\Client\IndexController')->get_advert($group_id);

        $advert_home = app('App\Http\Controllers\Client\IndexController')->get_advert_home();
        /*
         * video new
         */

        $list_comment = DB::table($this->db->comment)->where('idnew',$articel->id)->where('status',1)->get();

        if ($list_comment->count()){
            foreach ($list_comment as $comment){
                if(time() - $comment->created_at > 86400) {
                    $comment->created_at = date('H:m, d/m/Y ',$comment->created_at);
                }else {
                    $time = time() - $comment->created_at;
                    $comment->created_at = round($time/3600,0,PHP_ROUND_HALF_DOWN).' giờ trước';
                }
            }
        }


        $list_video_new = $this->get_video_new();
        $data = [
            'list_group' => $list_group,
            'articel_detail' => $articel,
            'articel_related_3' => $articel_related_3,
            'articel_related_5' => $articel_related_5,

            'articel_top_view' => $articel_top_view,
            'magazine_new' => $magazine_new,
            'list_video_new' => $list_video_new,
            'list_ad'=> $advert,
            'ad_home' => $advert_home,
            'relates' => $relates,

            'list_comment' => $list_comment
        ];


        return view('client.articel.detail',$data);
    }

    function articel_top_view($list_group){
        $list_articel = DB::table($this->db->news)->whereIn('id',$list_group)->orderBy('view')->where('status',1)->where('release_time','<=',time())->orderByDesc('release_time')->take(5)->get();

        return $list_articel;
    }

    public function get_magazine_new(){
        $magazine = DB::table($this->db->magazine)->orderByDesc('id')->first();
        $magazine->slide_show = json_decode($magazine->slide_show);
        return $magazine;
    }

    public function get_video_new(){
        $list_video_new = DB::table($this->db->video)->where('status',1)->where('release_time', '<=', time())->orderByDesc('release_time')->take(5)->get();
        return $list_video_new;
    }

    public function recusive_menu_parent($list_menu,$parentid,&$result,&$group_related){
        foreach ($list_menu as $key => $val){
//            if($val->parentid == $parentid) $group_related[] = $val->id;
            if($val->id == $parentid){
                if($val->parentid == 0) $group_related = $val->id;
                $result[] = $val->id;
                unset($list_menu[$key]);
                $this->recusive_menu_parent($list_menu,$val->parentid,$result,$group_related);
            }
        }
    }


    public function action_comment(Request $request){
        $comment = $request->get('comment');

        $ipaddress = $this->getUserIpAddr();

        $comment['IP'] = $ipaddress;

        $comment['created_at'] = time();

        $link = $comment['slug'].'---n-'.$comment['idnew'];

        unset($comment['slug']);

        if(Comment_vn::create($comment)){
            return redirect()->route('get_detail_articel',$link)->with('success','Bình luận bài viết thành công');
        }else {
            return redirect()->route('get_detail_articel',$link)->with('success','Bình luận bài viết không thành công');
        }
    }


    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
