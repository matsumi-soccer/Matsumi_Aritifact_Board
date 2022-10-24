@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>chat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script src="{{ asset('/js/search.js') }}"></script>
        <link rel="stylesheet" href="/css/index.css">
        <!--font-->
        <link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="main">
            <!--左サイドバー-->
            <div class="sidebar">
                <!--検索機能-->
                <div class="search">
                    <form method="GET" action="/search">
                        <input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                        <div>
                            <table>
                                <tr>
                                    <td><button type="submit", data-action="/search">検索</button></td>
                                    <td><button><a href="/" id="link_color">クリア</a></button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                    <p></p>
                </div>
                
                <!--followerランキング-->
                <div class="follower_lankings">
                    <p class="follower_lanking"><a href="/post/follower_lanking">フォロワーランキング</a></p>
                    <div class="follower_top">
                        <?php $count_rank=1?>
                        @foreach($follows as $follow)
                            @foreach($comments as $comment)
                                <?php if (($comment->user->id) == ($follow->followed_user_id)) : ?>
                                    <a href="/posts_userpage/{{$comment->id}}">{{$count_rank}}位：{{$comment->user->name}}</a>
                                    @break
                                <?php else: ?>
                                    @continue
                    　　          <?php endif; ?>
                            @endforeach
                            <p>フォロワー：{{$follow->count_userid}}人</p>
                            <?php $count_rank+=1 ?>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!--掲示板-->
            <div class="content">
                <h1>Sophisticated Game Board</h1>
                <div class='posts'>
                    <div class='post'>
                        <ul>
                            <!--apexchat欄-->
                            <li><div class="apexs main-block">
                               <h3>Apex Legensds</h3>
                               @foreach ($apex as $apex) 
                                    <div class="apex_rank">
                                        <p class="rank_chat">
                                            <a href="/apex/{{$apex->id}}">{{$apex->rank}}</a>
                                        </p>
                                    </div>
                                @endforeach
                            </div></li>
                            
                            <!--valorantchat欄-->
                            <li><div class="valorants main-block">
                                <h3>Valorant</h3>
                                @foreach ($valorant as $valorant) 
                                    <div class="valorant_rank">
                                        <p class="rank_chat">
                                            <a href="/valorant/{{$valorant->id}}">{{$valorant->rank}}</a>
                                        </p>
                                    </div>
                                @endforeach
                            </div></li>
                            
                            <!--PUBGchat欄-->
                            <li><div class="pubgs main-block">
                                <h3>PUBG</h3>
                                @foreach ($pubg as $pubg) 
                                    <p class="rank_chat">
                                            <a href="/pubg/{{$pubg->id}}">{{$pubg->rank}}</a>
                                        </p>
                                @endforeach
                            </div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

@endsection