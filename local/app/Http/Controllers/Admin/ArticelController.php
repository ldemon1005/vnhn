<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticelController extends Controller
{
    public function get_list(Request $request)
    {
        /*
         *  lấy danh sách bài viết
         */
        $paramater = $request->get('articel');

        $group_id = isset($paramater['group_id']) ? $paramater['group_id'] : [];
        $status = isset($paramater['status']) ? $paramater['status'] : [];
        $key_search = isset($paramater['key_search']) ? $paramater['key_search'] : [];

        $list_articel = DB::table('news_vn')->orderByDesc('id');

        if(count($status)){
            $list_articel = $list_articel->whereIn('status',$status);
        }

        if(count($group_id)){
            $list_articel_ids = DB::table('group_news_vn')->whereIn('group_vn_id',$group_id)->get(['news_vn_id'])->toArray();
            $list_articel_ids = array_column(json_decode(json_encode($list_articel_ids),true),'news_vn_id');

            $list_articel =  $list_articel->whereIn('id',$list_articel_ids);
        }

        if($key_search){
            $list_articel = $list_articel->where('title','like',"%$key_search%")->orWhere('summary','like',"%$key_search%");
        }

        $list_articel = $list_articel->paginate(15);
        foreach ($list_articel as $val) {
            $val->created_at = date('d/m/Y H:m', $val->created_at);
            $val->updated_at = date('d/m/Y H:m', $val->updated_at);
        }

        /*
         *  lấy danh sách danh mục
         */
        $list_group = DB::table('group_vn')->where('status', 1)->get()->toArray();
        $root = [
            'id' => 0,
            'title' => 'root'
        ];
        $result[] = (object)$root;
        $this->recusiveGroup($list_group, 0, "", $result);

        $data = [
            'list_group' => $result,
            'list_articel' => $list_articel,
            'articel' => $paramater
        ];

        return view('admin.articel.index', $data);
    }


    public function form_articel($id){
        /*
         *  lấy danh sách danh mục
         */
        $list_group = DB::table('group_vn')->where('status',1)->get()->toArray();
        $this->recusiveGroup($list_group,0,"",$result);

        $articel = (object)[];

        if($id == 0){
            $data = [
                'id' => 0,
                'title' => '',
                'titlephu' => '',
                'keywords' => '',
                'description_meta' => '',
                'groupid' => [],
                'summary' => '',
                'avatar' => '',
                'tacgia' => '',
                'nguontin' => '',
                'url_nguon' => '',
                'loaiview' => 0,
                'content' => ''
            ];

            $articel = (object)$data;
        }

        $data = [
            'articel' => $articel,
            'list_group' => $result
        ];

        return view('admin.articel.form_group',$data);
    }
}
