<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/regist','/api/login','/api/addAddress','/api/editAddress','/api/addCart'
        ,'/api/addOrder','/api/changePassword','/api/forgetPassword'
    ];
}
