<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=['name','province','city','county',
        'address','tel','name','is_default','user_id'];
}
