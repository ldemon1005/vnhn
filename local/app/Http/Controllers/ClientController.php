<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function upload_image(Request $request) {
        if (Input::hasFile('file'))
        {
            $image = $request->file;
            $img_name = $image->getClientOriginalName();
            if (!isset($image)) {
                $rs = [
                    'status' => '0',
                    'data' => [],
                    'message' => 'Có lỗi hệ thống xảy ra!',
                ];
                return json_encode($rs);
            }

            $date = getdate();
            $dir_name = $date['mday'] . '_' . $date['mon'] . '_' . $date['year'];

            $base_url = __DIR__."/../../../resources/uploads/";
            if (!file_exists($base_url . $dir_name)) {
                mkdir($base_url . $dir_name);
            }
            if (file_exists($base_url . $dir_name . '/' . $img_name)) {
                $img_name = md5(uniqid(rand(), true)) . '_' . $img_name;
            }
            $file_upload = $image->move($base_url.$dir_name,$img_name);
            if ($file_upload) {
                $rs = [
                    'status' => '1',
                    'data' => '/uploads/'.$dir_name . '/' . $img_name,
                    'path' => url('/').'/local/resources'.'/uploads/'.$dir_name . '/' . $img_name,
                    'message' => 'Thao tác thành công',
                    'name_img' => explode('.',$img_name)
                ];
                return json_encode($rs);
            }
        }
        else{
            return "file not present";
        }

    }

    function set_lang($lang){
        Session::put('lang',$lang);
        return json_encode([
            'status' => 1
        ]);
    }
}