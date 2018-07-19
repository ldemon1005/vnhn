<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = "adverts";
    protected $primaryKey = "ad_id";
    protected $graud = [];

    function advert_top(){
    	return $this->hasMany('App\Models\AdvertTop','adt_ad_id','ad_id');
    }
}
