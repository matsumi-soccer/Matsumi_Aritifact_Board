@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>chat</title>
        <link rel="stylesheet" href="/css/detail.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="search-body">
            <div class="result-comment">
               <h2>コメントの検索結果</h2>
                @foreach($comments as $comment)
                    <div class="content">
                        <p class="padding-bottom name">{{$comment->user->name}}</p>
                        <p class="padding-bottom">コメント：{{$comment->body}}</p>
                        <p class="padding-bottom">{{$comment->updated_at}}</p>
                    </div>
                @endforeach
                <div class='paginate'>
                    {{$comments->links()}}
                </div>
            </div>
            
            <div class="result-reply">
                <h2>リプライの検索結果</h2>
                @foreach($replies as $reply)
                    <div class="content">
                        <p class="padding-bottom name">{{$reply->user->name}}</p>
                        <p class="padding-bottom">リプライ：{{$reply->body}}</p>
                        <p class="padding-bottom">{{$reply->updated_at}}</p>
                    </div>
                @endforeach
                <div class='paginate'>
                    {{$replies->links()}}
                </div>
            </div>
            
             <div class="footer">
                <a href="/">homeへ戻る</a>
            </div>
        </div>
    </body>
</html>

@endsection