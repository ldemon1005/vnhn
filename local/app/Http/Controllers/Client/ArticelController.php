<?php

namespace App\Http\Controllers\Client;

use App\Model\News;
use App\Models\Comment_vn;
use App\Models\AdvertTop;
use App\Models\Advert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ArticelController extends Controller
{
    public function get_detail($slug){
        $slug = explode('---n-',$slug);

        $articel = News::find($slug[1]);

        $articel->update(['ncount' => $articel->ncount + 1]);

        $content = DB::table($this->db->logfile)->where('LogId',$slug[1])->whereNotNull('noidung')->where('noidung','!=','')
            ->orderByDesc
        ('id')->first();

        $group_id = explode(',',$articel->groupid)[0];

        $groups = DB::table($this->db->group)->where('status',1)->get();

        $result = [];
        $group_related = [];

        $this->recusive_menu_parent($groups,$group_id,$result,$group_related);

        if(count($result)){
            $result = array_unique($result);

            $group_related = array_unique($group_related);
        }


        $list_group = DB::table($this->db->group)->where('status',1)->whereIn('id',$result)->get();

        $articel_related = DB::table($this->db->news)->whereIn('groupid',$group_related)->where('status',1)->orderBy('order_item')
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

        if(Session::get('lang') == 'vn'){
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

        $articel_top_view = $this->articel_top_view($group_related);

        /*
         * magazine
         */
        $magazine_new = $this->get_magazine_new();

        
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


            'list_comment' => $list_comment
        ];

        return view('client.articel.detail',$data);
    }

    function articel_top_view($list_group){
        $list_articel = DB::table($this->db->news)->whereIn('groupid',$list_group)->orderBy('view')->orderByDesc('release_time')->take(5)->get();

        return $list_articel;
    }

    public function get_magazine_new(){
        $magazine = DB::table($this->db->magazine)->orderByDesc('id')->first();
        $magazine->slide_show = json_decode($magazine->slide_show);
        return $magazine;
    }

    public function get_video_new(){
        $list_video_new = DB::table($this->db->video)->where('release_time','<=',time())->where('status',1)->take(5)->get();
        return $list_video_new;
    }

    public function recusive_menu_parent($list_menu,$parentid,&$result,&$group_related){
        foreach ($list_menu as $key => $val){
            if($val->parentid == $parentid) $group_related[] = $val->id;
            if($val->id == $parentid){
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
