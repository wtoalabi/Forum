<?php

use App\Models\Forum\Thread;
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

/* Route::get('/threads', function(){
    return Thread::all();
});

Route::get('user/{id}', 'Users\UserProfileController@show');
Route::get('all-threads','Forum\ThreadsController@index');
Route::get('single-thread/{slug}', "Forum\ThreadsController@show");
Route::post('create-new-thread', "Forum\ThreadsController@store" )->middleware('auth'); */