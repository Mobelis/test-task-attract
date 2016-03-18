<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/',     ['as' => 'home', 'uses' => 'NewsController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'NewsController@index']);
    // display single news
    Route::get('/news/{slug}',['as' => 'news.show', 'uses' => 'NewsController@show'])->where('slug', '[A-Za-z0-9-_]+');
});

Route::group(['middleware' => ['web','auth']], function()
{
    // show new news form
    Route::get('add-news',  ['as' => 'news.create', 'uses' => 'NewsController@create']);

    // save new news
    Route::post('add-news', ['as' => 'news.store', 'uses' => 'NewsController@store']);

    // edit post form
    Route::get('edit/{slug}','NewsController@edit');

    // update post
    //Route::post('update','NewsController@update');

    // add comment
    Route::post('comment/add','CommentController@store');

    // delete comment
    Route::post('comment/delete',['as' => 'comment.delete', 'uses' => 'CommentController@destroy']);

});
