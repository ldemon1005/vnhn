<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $menu;
    public $db;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->middleware(function ($request, $next) {
            $this->db = (object)$this->get_db();

            $this->menu = $this->get_menu_top();
            View::share('menu', $this->menu);

            if(Auth::user()){
                $level = Auth::user()->level;
                View::share('level', $level);
            }

            $info = $this->web_info();
            View::share('web_info',$info);
            return $next($request);
        });
    }

    public static function recusiveGroup($data,$parent_id = 0,$text = "",&$result){
        foreach ($data as $key => $item){
            if($item->parentid == $parent_id){
                $item->title = $text.$item->title;
                $result [] = $item;
                unset($data[$key]);
                self::recusiveGroup($data,$item->id,$text."--",$result);
            }
        }
    }

    public function get_menu_top(){
        $menu = DB::table($this->db->group)->where('status',1)->where('parentid','00')->orderBy('order')->get();
        foreach ($menu as $val){
            $val->child = DB::table($this->db->group)->where('parentid',$val->id)->get();
        }
        return $menu;
    }

    public function get_time($articel){
        if(time() - $articel->release_time > 86400) {
            $articel->release_time = date('d/m/Y H:m',$articel->release_time);
        }else {
            $time = time() - $articel->release_time;
            $articel->release_time = round($time/3600,0,PHP_ROUND_HALF_DOWN).' giờ trước';
        }
        return $articel;
    }


    function get_db(){
        $lang = Session::get('lang','vn');
        Config::set('app.locale',$lang);
        if($lang == 'vn'){
            return [
                'group_news' => 'group_news_vn',
                'group' => 'group_vn',
                'group_video' => 'group_video_vn',
                'menu_video' => 'menu_video_vn',
                'logfile' => 'logfile_vn',
                'menu_top' => 'menu_top_vn',
                'new_news' => 'new_news_vn',
                'news' => 'news_vn',
                'video' => 'video_vn',
                'web_info' => 'web_info_vn',
                'magazine' => 'magazine_vn'
            ];
        }else{
            return [
                'group_news' => 'group_news_en',
                'group' => 'group_en',
                'group_video' => 'group_video_en',
                'menu_video' => 'menu_video_en',
                'logfile' => 'logfile_en',
                'menu_top' => 'menu_top_en',
                'new_news' => 'new_news_en',
                'news' => 'news_en',
                'video' => 'video_vn',
                'web_info' => 'web_info_en',
                'magazine' => 'magazine_vn'
            ];
        }
    }


    function web_info(){
        $info = DB::table($this->db->web_info)->first();
        $info = (object)json_decode($info->info,true);
        return $info;
    }


    
}
