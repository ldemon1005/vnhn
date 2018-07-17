<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news_vn';

    public $timestamps = false;

    protected $guarded = [];

    function get_group(){
        return $this->belongsToMany(Group_vn::class,'group_news_vn','news_vn_id','group_vn_id')->get();
    }
}
