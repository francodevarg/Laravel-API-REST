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
    Route::post('users/logout','UserController@logout');
    
    Route::apiResource('posts', 'Api\PostController');
    
});



Route::get('profile/{user_id}',function($id){

    $user = App\User::find($id);

    /** 
     * 
    * $posts = $user->posts()
    * ->with('category','image','tags')
    * ->withCount('comments')->get();
    */
    $posts = $user->posts()->get();

    $data = [
        'user' => $user,
        'posts' => $posts,
    ];

    return response()->json($data, 200);


});