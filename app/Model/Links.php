<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Links extends Model
{
    use SoftDeletes;

    public $primaryKey = 'links_id';
    public $guarded = [];
}
