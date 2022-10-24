@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create</title>
    </head>
    <body>
        <p>User：{{Auth::user()->name}}</P>
        <p class ="mypage"><a href="/posts/mypage">MyPage</a></p>
        
        <h1>Game掲示板</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="body">
                <h2>comment書き込み</h2>
                <p>user_id={{Auth::user()->id}}</p><br>
                <div class="user_id">
                    <input type ="text" name = "comments[user_id]" placeholder = "user_id" value="{{old('comments.user_id')}}"/>
                    <p class="user_id__error" style="color:red">{{ $errors->first('comments.user_id') }}</p>
                </div>
                <div class="game_id">
                    <input type ="text" name = "comments[game_id]" placeholder = "game_id" value="{{old('comments.game_id')}}"/>
                    <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                </div>
                <div class="body">
                    <textarea name="comments[body]" placeholder="今日も1日お疲れさまでした。">{{old('comments.body')}}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                </div>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>

@endsection