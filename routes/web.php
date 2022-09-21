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
    Route::get('/posts/mypage', 'PostController@mypage');

    //コメント,リプライ保存
    Route::post('/posts', 'PostController@store');
    Route::post('/posts_reply', 'PostController@store_reply');
    
    //フォロー機能
    Route::post('/posts_follow', 'PostController@store_follow');
    
    //いいね機能
    Route::post('/posts_like', 'PostController@store_like');
    
    //followerランキング
    Route::get('/post/follower_lanking', 'PostController@follower_lanking');
    
    //検索機能
    Route::get('/search', 'PostController@search');
    
    //コメント,リプライ編集
    Route::get('/posts/{comment}/edit', 'PostController@edit');
    Route::put('/posts/{comment}', 'PostController@update');
    Route::get('/posts/reply/{reply}/edit', 'PostController@edit_reply');
    Route::put('/posts/reply/{reply}', 'PostController@update_reply');
    
    //ユーザーページ
    Route::get('posts_userpage/{comment}', 'PostController@userpage');

    //掲示板表示
    Route::get('/apex/{apex}', 'PostController@apex_chat');
    Route::get('/valorant/{valorant}', 'PostController@valorant_chat');
    Route::get('/pubg/{pubg}', 'PostController@pubg_chat');
    
    //コメント,リプライ削除,フォロー解除,いいね解除
    Route::delete('/posts/{comment}', 'PostController@delete');
    Route::delete('/posts/reply/{reply}', 'PostController@reply_delete');
    Route::delete('/posts_follow/{follow}', 'PostController@follow_delete');
    Route::delete('/posts_like/{like}', 'PostController@like_delete');

});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
?>