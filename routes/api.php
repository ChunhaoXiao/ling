<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'LoginController@store');
Route::middleware('auth:api')->get('index', function(){
	return ['hellos'];
});

Route::middleware('auth:api')->group(function(){
	Route::get('/categories', 'CategoryController@index');
	Route::get('/swipers', 'SwiperController@index');
	Route::get('/recommend', 'RecommendController@index');
	Route::get('/user', 'UserController@index');
	Route::put('/user', 'UserController@update');

	Route::resource('posts', 'PostController')->only('index', 'show');
	Route::post('/{post}/comments', 'PostCommentController@store');
	Route::get('/{post}/comments', 'PostCommentController@index');
	Route::post('likes', 'PostLikeController@store');
	Route::post('/collections', 'CollectionController@store');
	Route::get('/myrelatedposts', 'MyRalatedPostController@index');
});
