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
    Route::get('profile/{user}', 'Users\UserProfileController@show');
    Route::get('all-threads','Forum\ThreadsController@index'); 
    Route::get('single-thread/{slug}', "Forum\ThreadsController@show");
    Route::get('single-thread-replies/{thread}', "Forum\RepliesController@index");
    Route::post('create-new-thread', "Forum\ThreadsController@store" )->middleware('auth');
    Route::post('create-new-reply/{id}', "Forum\RepliesController@store" )->middleware('auth');
    Route::get('categories', 'Forum\CategoriesController@index');
    Route::get('category-threads/{category}', 'Forum\SingleCategoryThreadsController@index');
    Route::get('user-threads/{username}', 'Forum\UserThreadsController@index');
    Route::get('filter-threads/{filter}', 'Forum\FilteredThreadsController@index');
    Route::get('sort-threads/{sortQuery}', 'Forum\SortedThreadsController@index');
    Route::post('like-thread/{thread}', 'Forum\LikesController@likeThread');
    Route::post('like-reply/{reply}', 'Forum\LikesController@likeReply');
    //Route::get('profile/{user}')
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');