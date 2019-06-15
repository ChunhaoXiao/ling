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

Route::prefix('admin')->namespace('Admin')->group(function()
{
	Route::resource('categories', 'CategoryController');
	Route::resource('posts', 'PostController');
	Route::resource('users', 'UserController');
	Route::post('/uservip', 'UserVipController@store')->name('vip.store');
});