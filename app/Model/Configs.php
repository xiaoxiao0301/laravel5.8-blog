<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configs extends Model
{
    use SoftDeletes;

    public $primaryKey = 'configs_id';
    public $guarded = [];
}
