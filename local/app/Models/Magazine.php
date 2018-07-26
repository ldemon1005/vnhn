<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Magazine extends Model
{
    //

    protected $table = 'magazine_vn';

    public $timestamps = false;

    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'magazine_vn';
        }else {
            $this->table = 'magazine_en';
        }
    }
}
