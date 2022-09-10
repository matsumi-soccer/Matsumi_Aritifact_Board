<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|a
*/
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'PostController@index');
    Route::get('/create', 'PostController@create');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/mypage', 'PostController@mypage');
    
    Route::post('/posts_reply', 'PostController@store_reply');
    
    Route::get('/posts/{comment}/edit', 'PostController@edit');
    Route::put('/posts/{comment}', 'PostController@update');
    
    Route::get('/apex/{apex}', 'PostController@apex_chat');
    Route::get('/valorant/{valorant}', 'PostController@valorant_chat');
    Route::get('/pubg/{pubg}', 'PostController@pubg_chat');
    
    Route::delete('/posts/{comment}', 'PostController@delete');

});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
?>