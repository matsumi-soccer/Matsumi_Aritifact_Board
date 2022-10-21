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
// Twitterログイン
Route::get('/login/twitter', 'TwitterController@redirectToProvider')->name('twitter.login');
Route::get('/login/twitter/callback', 'TwitterController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'PostController@index');
    Route::get('/create', 'PostController@create');
    Route::get('/posts/mypage', 'PostController@mypage');
    
    //画像保存
    Route::post('add_image', 'AddImageController@addImage')->name('add_image');
    
    //コメント,リプライ保存
    Route::post('/posts', 'PostController@store');
    Route::post('/posts_reply', 'PostController@store_reply');

    //非同期フォロー機能
    Route::post('users/{user}/follow', 'FollowUserController@follow');
    Route::post('users/{user}/unfollow', 'FollowUserController@unfollow');
    
    //非同期いいね機能
    Route::get('posts/{comment}/favorites', 'FavoriteController@store');
    Route::get('posts/{comment}/unfavorites', 'FavoriteController@destroy');
    Route::get('posts/{comment}/countfavorites', 'FavoriteController@count');
    Route::get('posts/{comment}/hasfavorites', 'FavoriteController@hasfavorite');
    
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
    
    //rankname探索
    Route::get('/search/{apex}/apexrank_search', 'PostController@apexrank_search');
    Route::get('/search/{valorant}/valorantrank_search', 'PostController@valorantrank_search');
    Route::get('/search/{pubg}/pubgrank_search', 'PostController@pubgrank_search');
    
    //コメント,リプライ削除,フォロー解除,いいね解除
    Route::delete('/posts/{comment}', 'PostController@delete');
    Route::delete('/posts/reply/{reply}', 'PostController@reply_delete');
    
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

?>