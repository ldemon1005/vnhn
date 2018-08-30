<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class News extends Model
{
    protected $table = 'news_vn';

    public $timestamps = false;

    protected $guarded = [];

    const TINTONGHOP = 1;
    const TINSANXUAT = 2;
    const TINBIENTAP = 3;
    const TINCOPY = 4;
    const TINDICH = 5;
    const TINANH = 6;
    const TINVIDEO = 7;
    const BAIDACBIET = 8;
    const BAIBINHLUAN = 9;
    const BAIPR = 10;
    
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
