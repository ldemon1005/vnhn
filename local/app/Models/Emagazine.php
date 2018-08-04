<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emagazine extends Model
{
    protected $table = "emagazines";
    protected $primaryKey = "e_id";
    protected $graud = [];
    public $timestamps = false;
    
    function acc(){
    	return $this->belongsTo('App\Models\Account', 'e_acc_id');
    }
}
