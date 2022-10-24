@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit_Reply</title>
        <link rel="stylesheet" href="/css/edit.css">
    </head>
    <body>
        <div class="edit-body">
        
            <h2 class="title">リプライ編集</h2>
            <div class="content">
                <form action="/posts/reply/{{$reply->id}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="content__body">
                      <p class="padding-bottom">リプライ</p>
                      <input type ="hidden" name = "replies[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                      <input type ="hidden" name = "replies[game_id]" placeholder = "{{$reply->game_id}}" value="{{$reply->game_id}}"/>
                      <input type ="hidden" name = "replies[comment_id]" placeholder = "{{$reply->comment_id}}" value="{{$reply->comment_id}}"/>
                      <textarea name="replies[body]" cols="60" rows="6">{{$reply->body}}</textarea>
                      <p>コメント日時：{{$reply->created_at->format('Y/m/d h:m')}}</p>
                  </div>
                  <input type="submit" value="更新">
              </form>
            </div>
            
            <div class="footer"><a href="/posts/mypage">mypage / </a><a href="/">home</a></div>
        </div>
    </body>
    
</html>
@endsection