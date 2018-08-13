<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report_article(Request $request){
        $data = $request->all();

        $user = DB::table('accounts');

        $from = strtotime(date('Y-m-1 0:0'));

        $to = time();

        if (isset($data['key'])){
            $key = '%'.$data['key'].'%';
            $user = $user->where('username','like',$key)->orWhere('email','like',$key)->orWhere('fullname','like',$key);
        }

        $list_user = $user->get();

        if (isset($data['from']) && isset($data['to'])){
            $from = strtotime($data['from']."00:00");
            $to = strtotime($data['to']."23:59");
        }
        foreach ($list_user as $user){
            $tong_hop = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',1)->where('status',1)->count();
            $tu_viet = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',2)->where('status',1)->count();
            $chua_dang = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('status','!=',1)->count();

            $user->tong_hop = $tong_hop;
            $user->tu_viet = $tu_viet;
            $user->chua_dang = $chua_dang;
        }

        $data = [
            'list_user' => $list_user,
            'key' => isset($data['key'])? $data['key'] : ''
        ];

        return view('admin.articel.report_article',$data);
    }
}
