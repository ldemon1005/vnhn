<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertTop extends Model
{
    protected $table = "advert_top";
    protected $primaryKey = "adt_id";
    protected $graud = [];

    function advert(){
    	return $this->belongsTo('App\Models\Advert','adt_ad_id');
    }
    function group(){
    	return $this->belongsTo('App\Models\Groupvn','adt_gr_id');
    }
}
