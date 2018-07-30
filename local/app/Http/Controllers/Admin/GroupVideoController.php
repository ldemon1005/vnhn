<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GroupVideoController extends Controller
{
    function index(){
        $list_group = DB::table($this->db->group)->where('type',1)->paginate(10);
        foreach ($list_group as $group){
            $group->created_at = date('d/m/Y H:m',$group->created_at);
        }
        return view('admin.group.index');
    }
}
