<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class GroupNews_vn extends Model
{
    protected $table = 'group_news_vn';

    public $timestamps = false;

    protected $guarded = [];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Session::get('lang', 'vn') == 'vn') {
            $this->table = 'group_news_vn';
        } else {
            $this->table = 'group_news_en';
        }
    }
}
