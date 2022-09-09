@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <p>User：{{Auth::user()->name}}</P>
        <p class ="mypage"><a href="/posts/mypage">MyPage</a></p>
        
        <h1 class="title">
            PLAYERUNKNOWN'S BATTLEGROUNDS：{{$pubg->rank}}帯掲示板
        </h1>
        
        <div class="content">
            <div class="content__post">
                @foreach($comments as $comment)

                <?php if ($comment->game_id == 3) : ?>
                    <p>コメント：{{$comment->body}}</p>
                    
            　　<?php else: ?>
            　　<?php endif; ?>
            　　@endforeach

                <p>-----------------------------------------------------------------------</p>
            </div>
        </div>
        
         <form action="/posts" method="POST">
            @csrf
            <div class="body">
                <h2>comment書き込み</h2>
                <div class="user_id">
                    <p>user_id={{Auth::user()->id}}</p>
                    <input type ="text" name = "comments[user_id]" placeholder = "user_id" value="{{old('comments.user_id')}}"/>
                    <p class="user_id__error" style="color:red">{{ $errors->first('comments.user_id') }}</p>
                </div>
                <div class="game_id">
                    <p>game_id=3</p>
                    <input type ="text" name = "comments[game_id]" placeholder = "game_id" value="{{old('comments.game_id')}}"/>
                    <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                </div>
                <div class="body">
                    <textarea name="comments[body]" placeholder="PUBG Comment.">{{old('comments.body')}}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                </div>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection