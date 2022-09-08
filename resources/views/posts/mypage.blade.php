@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
    </head>
    <body>
        <h1 class="title">MyPage</h1>
        
        <br>
        <h2 class="title">My Rank</h2>
        <p>Apex Legends：{{Auth::user()->apex_rank}}</p>
        <p>Valorant：{{Auth::user()->valorant_rank}}</p>
        <p>PUBG：{{Auth::user()->pubg_rank}}</p>
        <br>
        
        <div class="chatted">
            <h2 class="title">過去のコメント一覧</h2>
             @foreach ($comments as $comment) 
                <div class="test">
                    <?php if ($comment->user_id == Auth::user()->id) : ?>
                        <p>コメント：{{$comment->body}}</p>
                        <p>投稿日時：{{$comment->created_at}}</p>
                        <p>更新日時：{{$comment->updated_at}}</p>
                        <p class="edit">[<a href="/posts/{{$comment->id}}/edit">編集</a>]</p>
                　　<?php else: ?>
                　　<?php endif; ?>
                </div>
            @endforeach
        </div>
    </body>
    
</html>
@endsection