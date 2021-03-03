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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile/{id}', function ($id) {

	$user = App\User::find($id);

	$posts  = $user->posts()
		->with('image')
		->withCount('comments')->get();

	$followers = $user->followers()->get();


	return view('welcome', [
		'user'   => $user,
		'posts'  => $posts,
		'followers' => $followers
	]);

});