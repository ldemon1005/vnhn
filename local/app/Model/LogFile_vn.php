<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogFile_vn extends Model
{
    protected $table = 'logfile_vn';
    public $timestamps = false;
     public $fillable = [
         'LogId','userId','GhiChu','noidung','created_at','groupid'
     ];
}
