<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable
{

    use HasRoles ;
    protected $guard_name = 'web';
    protected $fillable=['name', 'email', 'password'];
}
