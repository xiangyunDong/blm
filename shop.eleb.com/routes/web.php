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
Route::get('users/password','UserController@password')->name('users.password');
Route::patch('users/password','UserController@password1')->name('users.password1');
Route::resource('users','UserController');
Route::resource('shops','ShopController');
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::post('/upload','MenuController@upload')->name('upload');
Route::resource('menus','MenuController');
Route::resource('menu_categories','MenuCategoryController');
Route::resource('activities','ActivityController');
Route::get('orders/count','OrderController@count')->name('orders.count');
Route::resource('orders','OrderController');
Route::patch('orders/{order}/send','OrderController@send')->name('orders.send');
Route::patch('orders/{order}/cancel','OrderController@cancel')->name('orders.cancel');

