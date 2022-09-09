@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
    </head>
    <body>
        <p>User：{{Auth::user()->name}}</P>
        <p class ="mypage"><a href="/posts/mypage">MyPage</a></p>
        
        <h1 class="title">コメント編集</h1>
        <div class="content">
            <form action="/posts/{{$comment->id}}" method="POST">
              @csrf
              @method('PUT')
              <div class="content__body">
                  <input type ="text" name = "comments[user_id]" placeholder = "user_id"/><br>
                  <input type ="text" name = "comments[game_id]" placeholder = "game_id"/><br>
                  <input type='text' name='comments[body]' value="{{$comment->body}}">
              </div>
              <input type="submit" value="保存">
          </form>
        </div>
        
        <div class="back">[<a href="/posts/mypage">戻る</a>]</div>
    </body>
    
</html>
@endsection