<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $menu;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->menu = $this->get_menu_top();
        View::share('menu', $this->menu);
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

    public static function get_menu_top(){
        $menu = DB::table('group_vn')->where('status',1)->where('parentid','00')->orderBy('order')->get();
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

}
