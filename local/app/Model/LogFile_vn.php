<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class LogFile_vn extends Model
{
    protected $table = 'logfile_vn';
    public $timestamps = false;
    public $fillable = [
        'LogId', 'userId', 'GhiChu', 'noidung', 'created_at', 'groupid'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Session::get('lang', 'vn') == 'vn') {
            $this->table = 'logfile_vn';
        } else {
            $this->table = 'logfile_en';
        }
    }
    function acc(){
        return $this->belongsTo('App\Models\Account', 'userId');
    }
}
