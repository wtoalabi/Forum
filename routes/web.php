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
    return view('landing');
});

Route::get('/forums', function(){
    return view('forums.forums');
});
Route::group(['prefix' => 'api'], function () { 
    Route::get('/threads', function(){ return Thread::all(); }); 
    Route::get('user/{id}', 'Users\UserProfileController@show');
    Route::get('all-threads','Forum\ThreadsController@index'); 
    Route::get('single-thread/{slug}', "Forum\ThreadsController@show");
    Route::post('create-new-thread', "Forum\ThreadsController@store" )->middleware('auth');
    Route::post('create-new-reply/{id}', "Forum\RepliesController@store" )->middleware('auth');
    Route::get('categories', 'Forum\CategoriesController@index');
    Route::get('category-threads/{category}', 'Forum\SingleCategoryThreads@index');
    Route::get('user-threads/{username}', 'Forum\UserThreadsController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');