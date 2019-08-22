<?php

namespace App\Model;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admins extends Model
{
    use SoftDeletes;

    protected $fillable = ['username', 'password'];
}
