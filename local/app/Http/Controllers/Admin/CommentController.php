<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(Request $request){
        $data_req = $request->get('comment');
        $status = $data_req['status'];

        if($status){
            $list_comment = DB::table('comment_vn')->where('status',$status)->orderByDesc('id')->paginate(15);
        }else {
            $list_comment = DB::table('comment_vn')->orderByDesc('id')->paginate(15);
        }

        foreach ($list_comment as $comment){
            $comment->created_at = date('d/m/Y H:m',$comment->created_at);
            $comment->news = DB::table('news_vn')->find($comment->idnew);
        }


        $data = [
            'list_comment' => $list_comment
        ];
        return view('admin.comment.index',$data);
    }

    function update_status($id){
        $comment = Comment_vn::find($id);
        $check = 0;
        if($comment->status == 1){
            if($comment->update(['status' => 0])){
                $check = 1;
            }

        }else {
            if($comment->update(['status' => 1])){
                $check = 1;
            }
        }
        return json_encode([
            'status' => $check,
            'data' => $comment->status
        ]);
    }

    function delete_comment($id){
        if(DB::table($this->db->comment)->delete($id)){
            return redirect()->route('admin_comment')->with('success','Xóa thành công');
        }else {
            return redirect()->route('admin_comment')->with('error','Xóa không thành công');
        }
    }
}
