<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class LogFileVideo_vn extends Model
{
    protected $table = 'logfilevideo_vn';

    public $guarded = [];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'logfilevideo_vn';
        }else {
            $this->table = 'logfilevideo_en';
        }
    }
}
