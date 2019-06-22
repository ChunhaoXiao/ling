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

Route::prefix('admin')->namespace('Admin')->middleware('auth:admin')->group(function()
{
	Route::get('/', 'IndexController@index');
	Route::resource('categories', 'CategoryController');
	Route::resource('posts', 'PostController');
	Route::resource('users', 'UserController');
	Route::post('/uservip', 'UserVipController@store')->name('vip.store');
	Route::post('/logout', 'AuthController@logout')->name('admin.logout');
});

//管理员登录
Route::get('/admin/login', 'Admin\AuthController@showLoginForm')->name('admin.showlogin');
Route::post('/admin/login', 'Admin\AuthController@login')->name('admin.login');



//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
