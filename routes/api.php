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
Route::post('users/','UserController@store');
Route::post('users/login','UserController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('posts', 'Api\PostController');
    Route::post('users/logout','UserController@logout');
});