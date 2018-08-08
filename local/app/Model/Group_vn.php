<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Group_vn extends Model
{
    protected $table = 'group_vn';

    public $timestamps = false;

    protected $guarded = [];

    public function get_news(){
        return $this->belongsToMany(News::class,(new GroupNews_vn())->getTable(),'group_vn_id','news_vn_id')->where('status',1)->orderByDesc('id')->get();
    }

    public function get_news_take_4(){
        $list_articel = $this->belongsToMany(News::class,(new GroupNews_vn())->getTable(),'group_vn_id','news_vn_id')->where('status',1)->orderByDesc('id')->take(4)->get();
        foreach ($list_articel as $articel){
            $articel->release_time = date('d/m/Y H:m',$articel->release_time);
        }
        return $list_articel;
    }


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Session::get('lang', 'vn') == 'vn') {
            $this->table = 'group_vn';
        } else {
            $this->table = 'group_en';
        }
    }
}
