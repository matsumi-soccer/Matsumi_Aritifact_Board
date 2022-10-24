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
        <div class="follower-body">
            <h2>フォロワーランキング</h2>
            
            <div class="follower_top">
                <?php $count_rank=1?>
                @foreach($follows as $follow)
                <div class="ranks">
                    @foreach($comments as $comment)
                        <?php if (($comment->user->id) == ($follow->followed_user_id)) : ?>
                            <a href="/posts_userpage/{{$comment->id}}">{{$count_rank}} {{$comment->user->name}}</a>
                            @break
                        <?php else: ?>
            　　          <?php endif; ?>
                    @endforeach
                    <p>{{$follow->count_userid}}フォロワー</p>
                    <?php $count_rank+=1 ?>
                </div>
                @endforeach
            </div>
            
            
            <!--<a href='/create'>chat書き込み</a>-->
            <div class="footer">
                <a href="/">homeへ戻る</a>
            </div>
        </div>
    </body>
</html>

@endsection