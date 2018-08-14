<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\AdvertTop;
use App\Models\Groupvn;
use File;
use Illuminate\Support\Facades\Input;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Advert::orderBy('created_at', 'desc')->get();
        return view('admin.advert.advert', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advert.advert_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ad = new Advert;
        $ad->ad_name = $request->name;
        $request->link != null ? $ad->ad_link = $request->link : $ad->ad_link = 'http://vietnamhoinhap.vn/';
        $request->content != null ? $ad->ad_content = $request->content : $ad->ad_content = 'Không có';
        $ad->ad_status = 1;
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $ad->ad_img = saveImage([$image], 300, 'advert');
        }
        $ad->save();
        return redirect('admin/advert');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['item'] = Advert::find($id);
        return view('admin.advert.advert_add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad = Advert::find($id);
        $ad->ad_name = $request->name;
        $request->link != null ? $ad->ad_link = $request->link : $ad->ad_link = 'http://vietnamhoinhap.vn/';
        $request->content != null ? $ad->ad_content = $request->content : $ad->ad_content = 'Không có';
        $ad->ad_status = 1;
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = $ad->ad_img;
            File::delete('libs/storage/app/advert/'.$filename);
            File::delete('libs/storage/app/advert/resized-'.$filename);
            $ad->ad_img = saveImage([$image], 300, 'advert');
        }
        $ad->save();
        return redirect('admin/advert');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Advert::find($id);
        $filename = $ad->ad_img;
        File::delete('libs/storage/app/advert/'.$filename);
        File::delete('libs/storage/app/advert/resized-'.$filename);
        $ad_top = AdvertTop::where('adt_ad_id', $id)->get();
        foreach ($ad_top as $item) {
            $item->delete();
        }
        $ad->delete();
        return back();
    }

    public function getTop(){
        $gr_id = Groupvn::first()->id;
        return redirect('admin/advert/top/'.$gr_id.'/1');
        
    }

    public function getGroup($id, $lo_id){
        $data['item_tops'] = AdvertTop::where('adt_gr_id', $id)->where('adt_location', $lo_id)->get();
        $data['items'] = Advert::orderBy('created_at', 'desc')->get();
        $data['group']  = Groupvn::all();
        return view('admin.advert.advert_top', $data);
    }
    public function addTopAdvert($id, $lo_id, $ad_id){
        $adt = new AdvertTop;
        //id danh mục
        $adt->adt_gr_id = $id;
        //id quảng cáo
        $adt->adt_ad_id = $ad_id;
        //id_vị trí
        $adt->adt_location = $lo_id;
        //lưu 
        $adt->save();
        
        return back();
    }
    public function deleteTopAdvert($id){
        $adt = AdvertTop::find($id);
        $adt->delete();
        return back();
    }
    public function getOn(){

        $id = Input::get('id');
        
        $ad = Advert::find($id);
        $ad->ad_status = 1;
        $ad->save();
        return response($id, 200);

        
    }
    public function getOff(){
        $id = Input::get('id');
        
        $ad = Advert::find($id);
        $ad->ad_status = 0;
        $ad->save();
        return response('Success', 200);

        
    }
}
