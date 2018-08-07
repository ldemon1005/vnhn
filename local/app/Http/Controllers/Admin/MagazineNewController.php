<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MagazineNew;
use Illuminate\Support\Facades\Input;

use Auth;
use File;
class MagazineNewController extends Controller
{

    public function getList(){
        if (Auth::user()->level > 2 ) {
            $data['items'] = MagazineNew::orderBy('m_hot')->where('m_acc_id', Auth::user()->id)->paginate(12);
        }
        else{
            $data['items'] = MagazineNew::orderBy('m_hot')->paginate(12);
        }

        return view('admin.magazine_new.index', $data);
    }
    public function getAdd(Request $request){
        
        
        return view('admin.magazine_new.form');
    }
    public function postAdd(Request $request){

        try {
            $data = new MagazineNew;
            $data->m_title = $request->m_title;
            $data->m_slug = str_slug($request->m_title);
            
            //Lưu ảnh đại diện
            $image = $request->file('m_img');
            if ($request->hasFile('m_img')) {
                $data->m_img = saveImage([$image], 300, 'magazine');
            }
            //Lưu file giao diện
            // dd(Auth::user()->id);
            $data->m_acc_id = Auth::user()->id;
            $data->m_hot = 1;
            if (Auth::user()->level < 3) {
                $data->m_status = 1;
            }
            else{
                $data->m_status = 2;
            }
            $data->created_at = time();
            $data->save();
        }
        catch (\Exception $e) {
            return back()->with('error', 'Lỗi không thêm được bài');
        }
        return redirect('admin/magazine')->with('success', 'Thêm thành công');;
    }
    public function getEdit($id){
        $data['item'] = MagazineNew::find($id);
        return view('admin.magazine_new.form', $data);
    }
    public function postEdit(Request $request, $id){
        try {
            $data = MagazineNew::find($id);
            $data->m_title = $request->m_title;
            $data->m_slug = str_slug($request->m_title);
            
            //Lưu ảnh đại diện
            $image = $request->file('m_img');
            if ($request->hasFile('m_img')) {
                $data->m_img = saveImage([$image], 300, 'magazine');
            }
            //Lưu file giao diện
            // dd(Auth::user()->id);
            $data->m_acc_id = Auth::user()->id;
            $data->m_hot = 1;
            if (Auth::user()->level < 3) {
                $data->m_status = 1;
            }
            else{
                $data->m_status = 2;
            }
            $data->created_at = time();
            $data->save();
        }
        catch (\Exception $e) {
            return back()->with('error','Lỗi không thêm được bài');
        }
        return back()->with('success', 'Sửa thành công');
    }
    public function getDelete($id){
        $data = MagazineNew::find($id);
        $fileImg = $data->m_img;
        File::delete('libs/storage/app/magazine/'.$fileImg);
        File::delete('libs/storage/app/magazine/resized-'.$fileImg);
        $data->delete();
        return back()->with('success', 'Xóa bài thành công');
    }


    public function getSort(){
        $data['items'] = MagazineNew::orderBy('m_hot')->where('m_status',1)->get();
        return view('admin.magazine_new.sort',$data);
    }

    public function postSort(Request $request){
        $data = $request->get('items');
        // dd($data);
        $check = 1;
        foreach ($data as $key => $val){
            $e = MagazineNew::find($key);
            $e->m_hot = $val;
            $e->save();
            // if(!Emagazine::find($key)->update(['e_hot' => $val])) $check = 0;
        }
        if($check == 1){
            return back()->with('success','Sắp xếp thành công');
        }else{
            return back()->with('error','Sắp xếp không thành công');
        }
    }

    public function action_status(){
        // return response('success', 200);
        $id = Input::get('id');
        $status = Input::get('status');
        
        $e = MagazineNew::find($id);
        $e->m_status = $status;
        $e->save();
        return response($id, 200);
    }
}
