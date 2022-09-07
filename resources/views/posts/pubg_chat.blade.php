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
        <h1 class="title">
            PLAYERUNKNOWN'S BATTLEGROUNDS：{{$pubg->rank}}帯掲示板
        </h1>
        
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
            </div>
        </div>
        
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection