<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class MenuVideo extends Model
{
    protected $table = 'menu_video';

    public $timestamps = false;

    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'menu_video';
        }else {
            $this->table = 'menu_video';
        }
    }
}
