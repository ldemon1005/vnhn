<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\News;
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



        return view('admin.index.home');
    }
}
