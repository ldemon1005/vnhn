<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\News;
use App\Models\Video_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome(){
//        $array = [
//            "hotline" => "0964.32.83.83",
//            "license" => "Giấy phép số 153/GP- Cục PTTHTTĐT - Bộ thông tin và truyền thông cấp ngày 17/05/2017",
//            "editor_in_chief" => "Đoàn Mạnh Phương",
//            "deputy_editor" => "Nhà báo Trần Văn Ánh",
//            "senior_executive_editor" => "ĐOÀN CÔNG CHUNG",
//            "address" => "Tầng 8 Cung Tri thức thành phố, số 1 Tôn Thất Thuyết, phường Dịch Vọng Hậu, quận Cầu Giấy, Hà Nội",
//            "phone" => "02437823798 * 02437823799",
//            "email" => "info@vietnamhoinhap.com",
//            "facebook" => null,
//            "youtobe" => null,
//            "link_googleplay" => null,
//            "link_appstore" => null,
//            "summary_1" => "Viện Chính sách, Pháp luật và Quản lý",
//            "summary_2" => "Liên hiệp các Hội Kho",
//        ];
//
//        dd(json_encode($array));

//        cập nhật data hot item
//        $list_id = DB::table('group_news_vn')->where('hot' ,1)->get()->toJson();
//
//        $list_id = array_column(json_decode($list_id,true),'news_vn_id');
//
//        $list_article = DB::table('news_vn')->where('release_time', '<=',1533488306)->whereIn('id',$list_id)->get(['id'])->toJson();
//
//        $list_article_id = array_column(json_decode($list_article,true),'id');
//
//        DB::table('group_news_vn')->whereIn('news_vn_id',$list_article_id)->update(['hot' => 0]);
//
//        dd("chào");

        //update time hot

        //        cập nhật data hot item
//        $list_id = DB::table('group_news_vn')->where('hot' ,1)->get()->toJson();
//
//        $list_id = array_column(json_decode($list_id,true),'news_vn_id');
//
//        $list_article = DB::table('news_vn')->whereIn('id',$list_id)->update(['time_hot_item' => time() + 86400*3]);

        //cập nhật time hot main

//        $list_article = DB::table('news_vn')->where('hot_main',1)->update(['time_hot_main' => time() + 86400*3]);
//
//        dd($list_article);


        return view('admin.index.home');
    }
}
