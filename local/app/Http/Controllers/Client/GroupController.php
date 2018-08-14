<?php

namespace App\Http\Controllers\Client;

use App\Model\Group_vn;
use App\Models\AdvertTop;
use App\Models\Advert;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Client\IndexController\get_advert;

class GroupController extends Controller{
    
    function get_articel_by_group($slug){
        $slug = explode('---n-',$slug);

        /*
         *  group menu
         */

        $group_menu = $this->menu_top_group($slug[1]);

        /*
         * list articel hot articel
         */

        $list_group = DB::table($this->db->group)->where('status',1)->get();

        $result[] = $slug[1];
        $this->recusive_find_child($list_group,$slug[1],$result);

        $result = array_unique($result);

        $list_articel_hot_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$result)->where('hot',1)->get(['news_vn_id'])->toJson();

        $list_articel_hot_ids = array_column(json_decode($list_articel_hot_ids,true),'news_vn_id');

        $list_articel_hot = DB::table($this->db->news)->whereNotNull('order_item')->whereIn('id',$list_articel_hot_ids)->where('status',1)->where('time_hot_item','>=',time())->where('release_time','<=',time())->orderBy('order_item')->orderBy('release_time','desc')->take(5)->get();


        /*
         *  articel top view
         */

        $list_articel_ids = DB::table($this->db->group_news)->whereIn('group_vn_id',$result)->get()->toJson();
        $list_articel_ids = array_column(json_decode($list_articel_ids,true),'news_vn_id');


        if($list_articel_hot->count() < 5){
            $number = 5 - $list_articel_hot->count();

            if($list_articel_hot->count() > 0){
                $list_not_ids = array_column(json_decode($list_articel_hot->toJson()),'id');
            }else $list_not_ids = [];

            $list_articel_hot_1 = DB::table($this->db->news)->where('status',1)->whereIn('id',$list_articel_ids)->whereNotIn('id',$list_not_ids)->where('release_time','<=',time())->orderByDesc('release_time')->take($number)->get();
            $list_articel_hot = $list_articel_hot->toBase()->merge($list_articel_hot_1);
        }

        foreach ($list_articel_hot as $val){
            $val->release_time = date('d/m/Y H:m',$val->release_time);
        }

        $articel_top_view = $this->articel_top_view($list_articel_ids);

        foreach ($articel_top_view as $val){
            $val->title = cut_string_name($val->title,70);
            $val->release_time = date('d/m/Y H:m',$val->release_time);
        }

        /*
         * list articel
         */

        $list_articel = DB::table($this->db->news)->whereIn('id',$list_articel_ids)->where('status',1)->orderByDesc('release_time')->paginate(7);

        $group_ids = array_column(json_decode($group_menu->toJson(),true),'id');

        unset($group_ids[0]);

        $group_articel = Group_vn::whereIn('id',$group_ids)->where('parentid',$slug[1])->where('status',1)->take(3)->get();

        foreach ($group_articel as $item){
            $item->articel = $item->get_news_take_4();
        }
        
        $advert = app('App\Http\Controllers\Client\IndexController')->get_advert($slug[1]);

        $advert_home = app('App\Http\Controllers\Client\IndexController')->get_advert_home();

        $list_video_new = $this->get_video_new();
        $data = [
            'group_menu_id' => $slug[1],
            'group_menu_cate' => $group_menu,

            'list_articel_hot' => $list_articel_hot,
            'articel_top_view' => $articel_top_view,

            'list_articel' => $list_articel,
            'group_articel' => $group_articel,

            'list_ad' => $advert,
            'ad_home' => $advert_home,

            'list_video_new' => $list_video_new
        ];


        return view('client.index.time',$data);
    }

    public function get_video_new()
    {
        $list_video_new = DB::table($this->db->video)->where('status',1)->where('release_time', '<=', time())->take(5)->get();
        return $list_video_new;
    }

    function articel_top_view($list_articel_ids){
        $articel_top_view = DB::table($this->db->news)->whereIn('id',$list_articel_ids)->where('status',1)->orderBy('view')->paginate(5);
        return $articel_top_view;
    }

    public function menu_top_group($group_id){
        $group = Group_vn::find($group_id);

        if($group->parentid == '00'){
            $ids[] = $group->id;
            $group_menu = DB::table($this->db->group)->where('parentid',$group_id)->where('status',1)->orderBy('order')->get();
            foreach ($group_menu as $menu){
                $ids[] = $menu->id;
            }
            $group_menu = DB::table($this->db->group)->whereIn('id',$ids)->where('status',1)->orderBy('parentid')->orderBy('order')->get();
        }else{
            $parentid = $group->parentid;
            $ids[] = $parentid;
            $group_menu = DB::table($this->db->group)->where('parentid',$parentid)->where('status',1)->orderBy('order')->get();
            foreach ($group_menu as $menu){
                $ids[] = $menu->id;
            }
            $group_menu = DB::table($this->db->group)->whereIn('id',$ids)->where('status',1)->orderBy('parentid')->orderBy('order')->get();
        }
        return $group_menu;
    }
    
}
