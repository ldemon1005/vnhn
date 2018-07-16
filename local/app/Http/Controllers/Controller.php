<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
