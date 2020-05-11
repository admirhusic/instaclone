<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// Profile routes

Route::get('/profile/{user}', 'ProfilesController@index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit');
Route::post('/profile/{user}/update', 'ProfilesController@update');


// Post routes
Route::get('/', 'PostsController@index');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p/store', 'PostsController@store');



// Follow route
Route::post('/follow/{user}', 'FollowsController@store');



// Comment route
Route::post('/comment/{post}', 'CommentsController@store');



// Like route

Route::post('/like/{post}', 'LikesController@store');

Route::post('/like/show/{post}', 'LikesController@show');
