<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// API posts

Route::get('posts/', 'ApiPostsController@index');


// API comments

Route::post('comments/', 'ApiCommentsController@store');


Route::get('comments/', 'ApiCommentsController@index');



// API likes


Route::post('likes/', 'ApiLikesController@store');