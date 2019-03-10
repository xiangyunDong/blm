<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $fillable=['url','permission_id','pid','name'];
}
