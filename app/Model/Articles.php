<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    public $primaryKey = 'art_id';

    public $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'art_cate_id', 'cate_id');
    }
}
