<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupvn extends Model
{
    protected $table = "group_vn";
    protected $primaryKey = "id";
    protected $graud = [];

    function advert_top(){
    	return $this->hasMany('App\Models\AdvertTop','adt_gr_id','id');
    }
}
