<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class News extends Model
{
    protected $table = 'news_vn';

    public $timestamps = false;

    protected $guarded = [];

    function get_group(){
        return $this->belongsToMany(Group_vn::class,(new GroupNews_vn())->getTable(),'news_vn_id','group_vn_id')->get();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'news_vn';
        }else {
            $this->table = 'news_en';
        }
    }
}
