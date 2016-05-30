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

Route::get('/', 'indexController@index');
Route::get('/indexno', 'indexController@nobbdd');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::get('/characters', 'characterController@index');
Route::get('/characters/{id}', 'characterController@show');
Route::get('/personajestatic', 'characterController@manual');
Route::get('/personajestatic/1', 'characterController@manualshow');
Route::get('/story', 'historyController@index');
Route::get('/storystatic', 'historyController@nobbdd');
Route::get('/gameplay', 'mechanicController@index');
Route::get('/gameplaystatic', 'mechanicController@nobbdd');

Route::get('showuser/{id}','Auth\userController@show' );
Route::get('/detailuser', 'Auth\userController@editUser');
Route::post('/updateuser', 'Auth\userController@updateUser');
Route::get('/backend', 'backendController@index');
Route::get('/backend/editPost/{id}', 'backendController@editpostview');

Route::get('backend/deletepost/{id}', 'backendController@deletepost');
Route::get('/backend/createpost', 'backendController@createpostview');
Route::post('/backend/createpost', 'backendController@createPost');
Route::post('/backend/editpost', 'backendController@editPost');
Route::get('/blog', 'blogController@index');
Route::get('/blog', 'blogController@index');
Route::get('/blog/{id}', 'blogController@show');
Route::get('/blog/category/{id}', 'blogController@bycategory');
Route::get('/blog/{id}/{comment}', 'blogController@editComment');
Route::post('/blog/comment', 'blogController@storeComment');
Route::post('/blog/updateComment', 'blogController@storeEditComment');
