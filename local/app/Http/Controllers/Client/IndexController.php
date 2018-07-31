<?php

namespace App\Http\Controllers\Client;

use App\Model\Group_vn;
use App\Models\AdvertTop;
use App\Model\News;
use App\Models\Video_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        /*
         *  phần new
         */
//        $menu = $this->get_menu_top();

        $list_articel_new = $this->get_new_articel();

        $list_video_new = $this->get_video_new();

        $magazine_new = $this->get_magazine_new();
        /*
         * group thứ nhất
         */

        $articel_times_1 = $this->get_articel_item(0);


        /*
         *  danh sách bào viết theo danh mục
         */

        $groups = $this->get_articel_group();


        /*
         *  group thứ 2
         */

        $articel_times_2 = $this->get_articel_item(1);

        $advert = $this->get_advert(1);
        $advert_home = $this->get_advert_home();
        $data = [
//            'menu' => $menu,
            'list_articel_new' => $list_articel_new,
            'list_video_new' => $list_video_new,
            'magazine_new' => $magazine_new,

            'menu_parent_item' => $articel_times_1['menu_time'],
            'menu_child_item' => $articel_times_1['menu_child'],
            'list_articel_item' => $articel_times_1['list_articel'],
            'list_top_view' => $articel_times_1['list_top_view'],

            'menu_parent_item_2' => $articel_times_2['menu_time'],
            'menu_child_item_2' => $articel_times_2['menu_child'],
            'list_articel_item_2' => $articel_times_2['list_articel'],

            'list_group' => $groups,
            'list_ad' => $advert,
            'ad_home' => $advert_home
        ];


        return view('client.index.index', $data);
    }

    public function home()
    {
        return redirect('');
    }

    public function time()
    {
        return view('client.index.time');
    }

    public function get_new_articel()
    {
        $list_articel_new = DB::table($this->db->news)->where('hot_main', 1)->where('release_time', '<=', time() + 43200)->orderBy('order_main')->orderByDesc('release_time')->take(10)->get();
        foreach ($list_articel_new as $item) {
            if (time() - $item->release_time > 86400) {
                $item->release_time = date('d/m/Y H:m', $item->release_time);
            } else {
                $time = time() - $item->release_time;
                $item->release_time = round($time / 3600, 0, PHP_ROUND_HALF_DOWN) . ' giờ trước';
            }
        }
        return $list_articel_new;
    }

    public function get_video_new()
    {
        $list_video_new = DB::table($this->db->video)->where('release_time', '<=', time())->take(5)->get();
        return $list_video_new;
    }

    public function get_magazine_new()
    {
        $magazine = DB::table($this->db->magazine)->orderByDesc('id')->first();
        $magazine->slide_show = json_decode($magazine->slide_show);
        return $magazine;
    }

    public function get_articel_item($position)
    {
        $menu_time = DB::table($this->db->group)->where('home_index', 1)->where('type', '!=', 1)->orderBy('order')->take(2)->get()->chunk(1);

        $menu_time = $menu_time[$position][$position];

        $menu_child = DB::table($this->db->group)->where('parentid', $menu_time->id)->get();

        $list_group_ids[] = $menu_time->id;

        foreach ($menu_child as $menu) {
            $list_group_ids[] = $menu->id;
        }

        $list_articel_ids = DB::table($this->db->group_news)->whereIn('group_vn_id', $list_group_ids)->get(['news_vn_id'])->toJson();
        $list_articel_ids = array_column(json_decode($list_articel_ids, true), 'news_vn_id');

        if ($position == 0) {
            $list_articel = DB::table($this->db->news)->whereIn('id', $list_articel_ids)->where('hot_item', 1)->orderBy('order_item')->take(3)->get();
        } else {
            $list_articel = DB::table($this->db->news)->whereIn('id', $list_articel_ids)->where('hot_item', 1)->orderBy('order_item')->take(4)->get();
        }

        foreach ($list_articel as $item) {
            if (time() - $item->release_time > 86400) {
                $item->release_time = date('d/m/Y H:m', $item->release_time);
            } else {
                $time = time() - $item->release_time;
                $item->release_time = round($time / 3600, 0, PHP_ROUND_HALF_DOWN) . ' giờ trước';
            }
        }

        $list_top_view = DB::table($this->db->news)->whereIn('id', $list_articel_ids)->orderByDesc('view')->take(5)->get();

        foreach ($list_top_view as $item) {
            if (time() - $item->release_time > 86400) {
                $item->release_time = date('d/m/Y H:m', $item->release_time);
            } else {
                $time = time() - $item->release_time;
                $item->release_time = round($time / 3600, 0, PHP_ROUND_HALF_DOWN) . ' giờ trước';
            }
        }
        return [
            'menu_time' => $menu_time,
            'menu_child' => $menu_child->take(4),
            'list_articel' => $list_articel,
            'list_top_view' => $list_top_view
        ];
    }

    public function get_articel_group()
    {
        $groups = Group_vn::where('home_index', 1)->where('status', 1)->where('type', '!=', 1)->orderBy('order')->take(10)->get()->slice(2, 8);

        foreach ($groups as $group) {
            $group->articel = $group->belongsToMany(News::class, $this->db->group_news, 'group_vn_id', 'news_vn_id')->orderByDesc('id')->take(5)->get();
        }
        $groups = $groups->chunk(4);
        return $groups;
    }

    public function get_advert($id)
    {
        $ads = AdvertTop::where('adt_gr_id', $id)->get();
        
        $ad = array();
        for ($i = 1; $i < 8; $i++) {
            $ad[$i] = AdvertTop::where('adt_gr_id', $id)->where('adt_location', $i)->get();
        }
        return $ad;
    }
    public function get_advert_home(){
        $ads = AdvertTop::where('adt_gr_id', 1)->get();
        $ad = array();
        for ($i = 1; $i < 8; $i++) {
            $ad[$i] = AdvertTop::where('adt_gr_id', 1)->where('adt_location', $i)->get();
        }
        return $ad;
    }
}
