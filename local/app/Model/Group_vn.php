<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group_vn extends Model
{
    protected $table = 'group_vn';

    public $timestamps = false;

    protected $guarded = [];

    public function get_news(){
        return $this->belongsToMany(News::class,'group_news_vn','group_vn_id','news_vn_id')->orderByDesc('id')->get();
    }

    public function get_news_take_4(){
        $list_articel = $this->belongsToMany(News::class,'group_news_vn','group_vn_id','news_vn_id')->orderByDesc('id')->take(4)->get();
        foreach ($list_articel as $articel){
            $articel->release_time = date('d/m/Y H:m',$articel->release_time);
        }
        return $list_articel;


    }
}
