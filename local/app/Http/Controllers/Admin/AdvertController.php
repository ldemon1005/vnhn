<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\AdvertTop;
use App\Models\Groupvn;
use File;

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
        $ad->ad_link = $request->link;
        $ad->ad_time = $request->time;
        $ad->ad_content = $request->content;
        $ad->ad_width = $request->width;
        $ad->ad_height = $request->height;
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
        $ad->ad_link = $request->link;
        $ad->ad_time = $request->time;
        $ad->ad_content = $request->content;
        $ad->ad_width = $request->width;
        $ad->ad_height = $request->height;
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
        $ad->delete();
        return back();
    }

    public function getTop(){
        $gr_id = Groupvn::where('title', 'Trang chủ')->first()->id;
        return redirect('admin/advert/top/'.$gr_id);
        
    }

    public function getGroup($id){
        $data['item_tops'] = AdvertTop::where('adt_gr_id', $id)->get();
        $data['items'] = Advert::orderBy('created_at', 'desc')->get();
        $data['group']  = Groupvn::all();
        return view('admin.advert.advert_top', $data);
    }
    public function addTopAdvert($id, $ad_id){
        $adt = new AdvertTop;
        $adt->adt_gr_id = $id;
        $adt->adt_ad_id = $ad_id;
        $adt->save();
        
        return back();
    }
    public function deleteTopAdvert($id){
        $adt = AdvertTop::find($id);
        $adt->delete();
        
        return back();
    }
}
