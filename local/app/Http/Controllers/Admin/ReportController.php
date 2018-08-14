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

        $user = $user->where('site',1);
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
            'key' => isset($data['key'])? $data['key'] : '',
            'from' =>  date('d/m/Y H:m',$from),
            'to' => date('d/m/Y H:m',$to)
        ];

        return view('admin.articel.report_article',$data);
    }

    public function detail_report_article($id,Request $request){

        $data = $request->all();

        $from = strtotime(date('Y-m-d 0:0'));

        $to = time();

        if (isset($data['from']) && isset($data['to'])){
            $from = strtotime($data['from']."00:00");
            $to = strtotime($data['to']."23:59");
        }

        $user = DB::table('accounts')->find($id);

        $list_article = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->paginate(20);

        $tong_hop = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',1)->where('status',1)->count();
        $tu_viet = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',2)->where('status',1)->count();
        $chua_dang = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('status','!=',1)->count();

        $user->tong_hop = $tong_hop;
        $user->tu_viet = $tu_viet;
        $user->chua_dang = $chua_dang;
        $user->total = $tong_hop + $tu_viet + $chua_dang;

        $data = [
            'user' => $user,
            'list_article' => $list_article,
            'from' => date('d/m/Y',$from),
            'to' => date('d/m/Y',$to),
        ];

        return view('admin.articel.detail_report_article',$data);
    }
}
