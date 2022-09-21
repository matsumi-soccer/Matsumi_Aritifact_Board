@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        
        <p>User：{{Auth::user()->name}}</P>
        <p class ="mypage"><a href="/posts/mypage">MyPage</a></p>
        
        <h2>検索結果</h2>
        @foreach($comments as $comment)
            <p>user：{{$comment->user->name}}</p>
            <p>コメント：{{$comment->body}}</p>
            <p>日時：{{$comment->updated_at}}</p>
            <p>------</p>
        @endforeach
        @foreach($replies as $reply)
            <p>user：{{$reply->user->name}}</p>
            <p>リプライ：{{$reply->body}}</p>
            <p>日時：{{$reply->updated_at}}</p>
            <p>------</p>
        @endforeach

        
        <div class='paginate'>
            {{$comments->links()}}
        </div>
        
         <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection