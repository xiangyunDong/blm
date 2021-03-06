<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//接口
Route::get('/api/bussiness_list','Api\ApiController@businessList');
Route::get('/api/bussiness','Api\ApiController@business');
Route::get('/view/api/sms','Api\ApiController@sms');
Route::post('/api/regist','Api\ApiController@regist');
Route::post('/api/login','Api\ApiController@login');
Route::get('/api/address_list','Api\ApiController@addressList');
Route::post('/api/addAddress','Api\ApiController@addAddress');
Route::get('/api/address','Api\ApiController@address');
Route::post('/api/editAddress','Api\ApiController@editAddress');
Route::get('/api/cart','Api\ApiController@cart');
Route::post('/api/addCart','Api\ApiController@addCart');
Route::post('/api/addOrder','Api\ApiController@addOrder');
Route::get('/api/Order','Api\ApiController@Order');
Route::get('/api/OrderList','Api\ApiController@OrderList');
Route::post('/api/changePassword','Api\ApiController@changePassword');
Route::post('/api/forgetPassword','Api\ApiController@forgetPassword');