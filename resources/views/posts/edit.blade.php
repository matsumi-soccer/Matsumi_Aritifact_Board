@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>chat</title>
        <link rel="stylesheet" href="/css/edit.css">
    </head>
    <body>
        <div class="edit-body">
            <h2 class="title">コメント編集</h2>
            <div class="content">
                <form action="/posts/{{$comment->id}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="content__body">
                      <p class="padding-bottom">コメント</p>
                      <input type ="hidden" name = "comments[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                      <input type ="hidden" name = "comments[game_id]" placeholder = "{{$comment->game_id}}" value="{{$comment->game_id}}"/>
                      <textarea name="comments[body]" placeholder="Edit comment." cols="60" rows="6">{{$comment->body}}</textarea>
                      <p>コメント日時：{{$comment->created_at->format('Y/m/d h:m')}}</p>
                  </div>
                  <input type="submit" value="更新">
              </form>
            </div>
            
            <div class="footer"><a href="/posts/mypage">mypage / </a><a href="/">home</a></div>
        </div>
    </body>
    
</html>
@endsection