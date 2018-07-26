<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Comment_vn extends Model
{
    protected $table = 'comment_vn';

    public $timestamps = false;

    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(Session::get('lang','vn') == 'vn'){
            $this->table = 'comment_vn';
        }else {
            $this->table = 'comment_en';
        }
    }
}
