@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        {{Auth::user()->name}}
        <h1>Game掲示板</h1>
        <div class='posts'>
            <h3 class='game_title'>APEX</h3>
            @foreach ($posts as $post)
            <div class='post'>
            <!--h3 class='title'>RankID:{{$post->id}}</h3>-->
                <p class='rank'>Rank:{{$post->User_id}}</p>
            </div>
            @endforeach
        </div>
    </body>
</html>

@endsection