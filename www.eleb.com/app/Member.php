<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Member extends Authenticatable
{
    protected $fillable=['username','tel','password','rememberToken'];
}
