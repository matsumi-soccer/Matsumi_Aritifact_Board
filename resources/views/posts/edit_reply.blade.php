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
        
        <h1 class="title">リプライ編集</h1>
        <div class="content">
            <form action="/posts/reply/{{$reply->id}}" method="POST">
              @csrf
              @method('PUT')
              <div class="content__body">
                  <input type ="hidden" name = "replies[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/><br>
                  <input type ="hidden" name = "replies[game_id]" placeholder = "{{$reply->game_id}}" value="{{$reply->game_id}}"/><br>
                  <input type ="hidden" name = "replies[comment_id]" placeholder = "{{$reply->comment_id}}" value="{{$reply->comment_id}}"/><br>
                  <input type='text' name='replies[body]' value="{{$reply->body}}">
              </div>
              <input type="submit" value="保存">
          </form>
        </div>
        
        <div class="back">[<a href="/posts/mypage">戻る</a>]</div>
    </body>
    
</html>
@endsection