<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
   protected $fillable=['events_id','member_id'];
}
