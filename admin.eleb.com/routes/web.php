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
    return view('index');
});
Route::post('/upload','ShopCategoryController@upload')->name('upload');
Route::resource('shop_categories','ShopCategoryController');
Route::resource('shops','ShopController');
Route::patch('shops/{shop}/audit','ShopController@audit')->name('shops.audit');
Route::resource('users','UserController');
Route::patch('users/{user}/reset','UserController@reset')->name('users.reset');
Route::get('admins/password','AdminController@password')->name('admins.password');
Route::patch('admins/password','AdminController@password1')->name('admins.password1');
Route::resource('admins','AdminController');
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::resource('activities','ActivityController');
Route::resource('members','MemberController');
Route::patch('members/{member}/reset','MemberController@reset')->name('members.reset');
Route::resource('roles','RoleController');
Route::resource('permissions','PermissionController');
Route::resource('navs','NavController');
Route::resource('events','EventController');
Route::resource('navs','NavController');
Route::resource('event_members','EventMemberController');
Route::resource('event_prizes','EventPrizeController');












