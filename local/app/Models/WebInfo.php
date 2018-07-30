<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebInfo extends Model
{
    protected $table = 'web_info';

    public $timestamps = false;

    public $guarded = [];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'web_info_vn';
        }else {
            $this->table = 'web_info_en';
        }
    }
}
