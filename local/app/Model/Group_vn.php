<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group_vn extends Model
{
    protected $table = 'group_vn';

    public $timestamps = false;

    protected $graud = [];

    public function get_news(){
        return $this->belongsToMany(News::class,'group_news_vn','group_vn_id','news_vn_id')->orderByDesc('id')->get();
    }
}
