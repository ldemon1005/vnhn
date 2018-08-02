<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GroupVideoController extends Controller
{
    function index(){
        $list_group = DB::table($this->db->menu_video)->paginate(15);

        foreach ($list_group as $group){
            $group->created_at = date('d/m/Y H:m',$group->created_at);
        }
        $data = [
            'list_group' => $list_group
        ];
        return view('admin.group_video.index',$data);
    }
}
