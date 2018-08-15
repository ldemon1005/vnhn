<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Emagazine;
use Illuminate\Support\Facades\Input;

use Auth;
use File;
class EmagazineController extends Controller
{
    public function getList(){
    	if (Auth::user()->level > 2 ) {
    		$data['items'] = Emagazine::orderBy('e_hot')->where('e_acc_id', Auth::user()->id)->paginate(12);
    	}
    	else{
    		$data['items'] = Emagazine::orderBy('e_hot')->paginate(12);
    	}


    	return view('admin.emagazine.index', $data);
    }
    public function getAdd(Request $request){
    	
		
    	return view('admin.emagazine.form');
    }
    public function postAdd(Request $request){

    	try {
		  	$data = new Emagazine;
		  	$data->e_title = $request->e_title;
		  	$data->e_slug = str_slug($request->e_title);
		  	$request->e_summary != null ? $data->e_summary = $request->e_summary : $data->e_summary = 'Việt Nam Hội Nhập' ;
		  	$request->e_title_meta != null ? $data->e_title_meta = $request->e_title_meta : $data->e_title_meta = $request->e_title;
		  	$data->e_keyword_meta = $request->e_keyword_meta;

		  	//Lưu ảnh đại diện
		  	$image = $request->file('e_img');
	        if ($request->hasFile('e_img')) {
	            $data->e_img = saveImage([$image], 1000, 'emagazine');
	        }
	        //Lưu file giao diện
	        $file_detail = $request->file('e_detail');
	        if ($request->hasFile('e_detail') && $file_detail->getClientOriginalExtension() == 'html') {
	           	$filename_save = 'file_'.date("Y-m-d").'_'.round(microtime(true));
	            $filename = $filename_save.'.'.$file_detail->getClientOriginalExtension();
				$foldername = 'folder_'.round(microtime(true));
	        	$file_detail->storeAs('file_emagazine/'.$foldername,$filename);
	        	$data->e_detail = $foldername.'/'.$filename;
	        	$data->e_folder = $foldername;
	        }
	        else{
	        	return back()->withInput(Input::all())->with('error' ,'Tệp không đúng định dạng');
	        }

			$muti_file = $request->muti_file;
			if (count($muti_file) != 0) {
				foreach ($muti_file as $file) {
					$filename = $file->getClientOriginalName();
					$file->storeAs('file_emagazine/'.$foldername ,$filename);
				}
	        }

	        $data->e_view = 0;
	        // dd(Auth::user()->id);
	        $data->e_acc_id = Auth::user()->id;
	        $data->e_hot = 1;
	        if (Auth::user()->level < 3) {
	        	$data->e_status = 1;
	        }
	        else{
	        	$data->e_status = 2;
	        }
	        $data->created_at = time();
	        $data->save();
		}
		catch (\Exception $e) {
			dd($e);
		    return back()->with('error', 'Lỗi không thêm được bài');
		}
    	return redirect('admin/emagazine')->with('success', 'Thêm thành công');;
    }
    public function getEdit($id){

    	$data['item'] = Emagazine::find($id);
    	return view('admin.emagazine.form', $data);
    }
    public function postEdit(Request $request, $id){
    	try {
		  	$data = Emagazine::find($id);
		  	$data->e_title = $request->e_title;
		  	$data->e_slug = str_slug($request->e_title);
		  	$request->e_summary != null ? $data->e_summary = $request->e_summary : $data->e_summary = 'Việt Nam Hội Nhập' ;
		  	$request->e_title_meta != null ? $data->e_title_meta = $request->e_title_meta : $data->e_title_meta = $request->e_title;
		  	$data->e_keyword_meta = $request->e_keyword_meta;

		  	//Lưu ảnh đại diện
		  	$image = $request->file('e_img');
	        if ($request->hasFile('e_img')) {
	            $data->e_img = saveImage([$image], 1000, 'emagazine');
	        }
	        $foldername = $data->e_folder;
	        //Lưu file giao diện
	        $file_detail = $request->file('e_detail');
	        if ($request->hasFile('e_detail') && $file_detail->getClientOriginalExtension() == 'html') {
				$filename_save = 'file_'.date("Y-m-d").'_'.round(microtime(true));
	            $filename = $filename_save.'.'.$file_detail->getClientOriginalExtension();
	        	$file_detail->storeAs('file_emagazine/'.$foldername,$filename);
	        	$data->e_detail = $foldername.'/'.$filename;
	        	$data->e_folder = $foldername;
	        }
	        else{
	        	return back()->withInput(Input::all())->with('error' ,'Tệp không đúng định dạng');
	        }
	        
			$muti_file = $request->muti_file;
			if (count($muti_file) != 0) {
				foreach ($muti_file as $file) {
					$filename = $file->getClientOriginalName();
					$file->storeAs('file_emagazine/'.$foldername ,$filename);
				}
	        }
	        // dd(Auth::user()->id);
	        $data->updated_at = time();
	        $data->save();
		}
		catch (\Exception $e) {
			dd( $e);
		    return back()->with('error','Lỗi không thêm được bài');
		}
    	return back()->with('success', 'Sửa thành công');
    }
    public function getDelete($id){
    	$data = Emagazine::find($id);
        $fileImg = $data->e_img;
        File::delete('libs/storage/app/emagazine/'.$fileImg);
        File::delete('libs/storage/app/emagazine/resized-'.$fileImg);

        File::delete('libs/storage/app/file_emagazine/'.$data->e_detail);
        $data->delete();
        return back()->with('success', 'Xóa bài thành công');
    }


    public function getSort(){
        $data['items'] = Emagazine::orderBy('e_hot')->where('e_status',1)->get();
        return view('admin.emagazine.sort',$data);
    }

    public function postSort(Request $request){
        $data = $request->get('items');
        // dd($data);
        $check = 1;
        foreach ($data as $key => $val){
        	$e = Emagazine::find($key);
        	$e->e_hot = $val;
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
        
        $e = Emagazine::find($id);
        $e->e_status = $status;
        $e->save();
        return response($id, 200);
    }
}
