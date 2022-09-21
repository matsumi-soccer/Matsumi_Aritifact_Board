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
        
        <h1>フォロワーランキング</h1>
        
        <div class="follower_top">
            <?php $count_rank=1?>
            @foreach($follows as $follow)
                @foreach($comments as $comment)
                    <?php if (($comment->user->id) == ($follow->followed_id)) : ?>
                        <a href="/posts_userpage/{{$comment->id}}">{{$count_rank}}位：{{$comment->user->name}}</a>
                        @break
                    <?php else: ?>
        　　          <?php endif; ?>
                @endforeach
                <p>フォロワー：{{$follow->count_userid}}人</p>
                <?php $count_rank+=1 ?>
                <p>-------</p>
            @endforeach
        </div>
        
        
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection