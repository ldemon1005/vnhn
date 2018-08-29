<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class LogFile_vn extends Model
{
    protected $table = 'logfile_vn';
    public $timestamps = false;
    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Session::get('lang', 'vn') == 'vn') {
            $this->table = 'logfile_vn';
        } else {
            $this->table = 'logfile_en';
        }
    }
}
