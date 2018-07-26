<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Groupvn extends Model
{
    protected $table = "group_vn";
    protected $primaryKey = "id";
    protected $graud = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'group_vn';
        }else {
            $this->table = 'group_en';
        }
    }

    function advert_top(){
    	return $this->hasMany('App\Models\AdvertTop','adt_gr_id','id');
    }


}
