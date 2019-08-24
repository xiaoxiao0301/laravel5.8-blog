<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navs extends Model
{
    use SoftDeletes;
    public $primaryKey = 'navs_id';
    public $guarded = [];
}
