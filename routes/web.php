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

Auth::loginUsingId(1);

Route::get('/', function () {
    return view('landing');
    
});

Route::get('/forums', function(){
    return view('forums.forums');
});
Route::group(['prefix' => 'api'], function () { 
    Route::get('profile/{user}', 'Users\UserProfileController@show');
    Route::get('activities/{user}', 'Users\UserActivitiesController@index');
    Route::get('threads/{filters?}','Forum\ThreadsController@index'); 
    Route::get('trending-threads','Forum\ThreadsController@trending'); 
    Route::get('single-thread/{slug}', "Forum\ThreadsController@show");
    Route::post('thread-subscription/{threadID}', "Forum\ThreadsSubscriptionController@store")->middleware('auth');
    Route::delete('thread-subscription/{threadID}', "Forum\ThreadsSubscriptionController@destroy")->middleware('auth');
    Route::delete('delete-thread/{slug}', "Forum\ThreadsController@destroy")->middleware('auth');
    Route::delete('delete-reply/{id}', "Forum\RepliesController@destroy")->middleware('auth');
    Route::get('single-thread-replies/{thread}', "Forum\RepliesController@index");
    Route::post('create-new-thread', "Forum\ThreadsController@store" )->middleware(['auth','must-be-confirmed']);
    Route::post('create-new-reply/{id}', "Forum\RepliesController@store" )->middleware(['auth','must-be-confirmed']);
    Route::patch('edit-reply/{id}', "Forum\RepliesController@update" )->middleware('auth');
    Route::get('categories', 'Forum\CategoriesController@index');
    Route::get('category-threads/{category}', 'Forum\SingleCategoryThreadsController@index');
    Route::get('user-threads/{username}', 'Forum\UserThreadsController@index');
    Route::get('filter-threads/{filter}', 'Forum\FilteredThreadsController@index');
    Route::get('sort-threads/{sortQuery}', 'Forum\SortedThreadsController@index');
    Route::post('like-thread/{thread}', 'Forum\LikesController@likeThread')->middleware('auth');
    Route::post('like-reply/{reply}', 'Forum\LikesController@likeReply')->middleware('auth');
    Route::delete('notifications/{notification}', 'Users\UserNotificationsController@destroy');
    Route::get('notifications', 'Users\UserNotificationsController@index')->middleware('auth');
    Route::post('get-mentioned-user', 'Users\MentionedUsersController@index');
    Route::post('user-avatar', 'Users\UserAvatarController@store');
    Route::get('confirm-token/{token}', 'Users\UserProfileController@confirm');
    Route::post('reply/mark-as-best/{reply}', 'Forum\MarkReplyAsBestController@store');
    Route::get('search/{query}', 'Forum\SearchController@index');

    //Route::get('profile/{user}')
});

Route::group(['prefix' => 'api/admin','middleware'=>['auth','admin']], function () {
    Route::post('lock/{thread}', 'Admin\LockThreadController@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');