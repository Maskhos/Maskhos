<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::get('/characters', 'characterController@index');
Route::get('/characters/{id}', 'characterController@show');
Route::get('/personajestatic', 'characterController@manual');
Route::get('/personajestatic/1', 'characterController@manualshow');
Route::get('/story', 'historyController@index');
Route::get('/gameplay', 'mechanicController@index');
Route::get('/gameplaystatic', 'mechanicController@nobbdd');
Route::get('/blog', 'blogController@index');
Route::get('/blog/{id}', 'blogController@show');
Route::get('/blog/{id}/{comment}', 'blogController@editComment');
Route::post('/blog/comment', 'blogController@storeComment');
///post/updateComment
Route::post('/blog/updateComment', 'blogController@storeEditComment');
