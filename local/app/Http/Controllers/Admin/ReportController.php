<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class ReportController extends Controller
{
    public function report_article(Request $request){
        if (Auth::user()->level < 3) {
            $data = $request->all();

            $user = DB::table('accounts');

            $from = strtotime(date('Y-m-1 0:0'));

            $to = time();

            if (isset($data['key'])){
                $key = '%'.$data['key'].'%';
                $user = $user->where('username','like',$key)->orWhere('email','like',$key)->orWhere('fullname','like',$key);
            }

            $user = $user->where('site', Auth::user()->site);
            $list_user = $user->get();

            if (isset($data['from']) && isset($data['to'])){
                $from = strtotime($data['from']."00:00");
                $to = strtotime($data['to']."23:59");
            }
            foreach ($list_user as $user){
                $user->tong_hop = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',1)->where('status',1)->count();
                $user->tu_viet = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',2)->where('status',1)->count();
                $user->bien_tap = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',3)->where('status',1)->count();
                $user->copy = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',4)->where('status',1)->count();

                $user->chua_dang = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('status','!=',1)->count();
                
            }

            $data = [
                'list_user' => $list_user,
                'key' => isset($data['key'])? $data['key'] : '',
                'from' =>  date('d/m/Y H:m',$from),
                'to' => date('d/m/Y H:m',$to)
            ];

            return view('admin.articel.report_article',$data);
        }
        else{
            return redirect('admin');
        }
            
    }

    public function detail_report_article($id,Request $request){
        if (Auth::user()->level > 2 && $id != Auth::user()->id) {
            return redirect('admin/report/detail_report_article/'.Auth::user()->id);
        }

        $data = $request->all();

        $from = strtotime(date('Y-m-1 0:0'));

        $to = time();

        if (isset($data['from']) && isset($data['to'])){
            $from = strtotime($data['from']."00:00");
            $to = strtotime($data['to']."23:59");
        }

        $user = DB::table('accounts')->find($id);

        $list_article = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->paginate(20);

        $user->tong_hop = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',1)->where('status',1)->count();
        $user->tu_viet = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',2)->where('status',1)->count();
        $user->bien_tap = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',3)->where('status',1)->count();
        $user->copy = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('loaitinbai',4)->where('status',1)->count();

        $user->chua_dang = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('status','!=',1)->count();
        $user->da_dang = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->where('status',1)->count();

        $user->total = DB::table($this->db->news)->where('userid',$user->id)->where('created_at','>=',$from)->where('created_at','<=',$to)->count();

        $data = [
            'user' => $user,
            'list_article' => $list_article,
            'from' => date('d/m/Y',$from),
            'to' => date('d/m/Y',$to),
        ];

        return view('admin.articel.detail_report_article',$data);
    }
}
