<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagazineNew extends Model
{
    protected $table = "magazine_news";
    protected $primaryKey = "m_id";
    protected $graud = [];
    public $timestamps = false;
    
    function acc(){
    	return $this->belongsTo('App\Models\Account', 'm_acc_id');
    }
}
