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
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <link rel="stylesheet" href="/css/userpage.css">
    </head>
    <body>
        <div class="content">
            <!--user情報-->
            <div class="user-detail">
                <div class="detail-left">
                    <h2>{{$comment->user->name}}</h2>
                
                    <!--非同期follow機能-->
                    <div class="follow-modeule">
                        <!--follow準備-->
                        <div class="follow-preparation">
                            <?php 
                                $user=$comment->user;
                                $user->load('followUsers');
                                $defaultCount = count($user->followUsers);
                                $defaultFollowed = false;
                            ?>
                            @foreach(($user->followUsers) as $user)
                                <?php if($user->pivot->following_user_id==\Auth::user()->id):
                                    $defaultFollowed = true;
                                ?>
                                    @break
                                <?php else: 
                                    $defaultFollowed = false;
                                ?>
                                <?php endif;?>
                            @endforeach
                        </div>
                        
                        <!--follow-vue-->
                        <div class="follow-vue">
                            <follow-component
                                :user = "{{ json_encode($comment->user) }}"
                                :default-Followed = "{{ json_encode($defaultFollowed) }}"
                                :default-Count = "{{ json_encode($defaultCount) }}"
                            ></follow-component>
                        </div>
                    </div>
                    <!--ゲームランク表示-->
                    <div class='posts'>
                        <h3 class="title">Game Rank</h3>
                        
                        <div class="my_apexrank">
                            @foreach($apexes as $apex)
                                <?php if(($apex->id)==($comment->user->apex_rank)): ?>
                                    <p>Apex Legends：{{$apex->rank}}</p>
                                <?php elseif(($comment->user->apex_rank) == 100): ?>
                                    <p>Apex Legends：unlanked</p>
                                    @break
                                <?php else: ?>
                                <?php endif; ?>
                            @endforeach
                        </div>
                        <div class="my_valorantrank">
                            @foreach($valorants as $valorant)
                                <?php if(($valorant->id)==($comment->user->valorant_rank)): ?>
                                    <p>Valorant：{{$valorant->rank}}</p>
                                <?php elseif(($comment->user->valorant_rank) == 100): ?>
                                    <p>Valorant：unlanked</p>
                                    @break
                                <?php else: ?>
                                <?php endif; ?>
                            @endforeach
                        </div>
                        <div class="my_pubgrank">
                            @foreach($pubgs as $pubg)
                                <?php if(($pubg->id)==($comment->user->pubg_rank)): ?>
                                    <p>PUBG：{{$pubg->rank}}</p>
                                <?php elseif(($comment->user->pubg_rank) == 100): ?>
                                    <p>PUBG：unlanked</p>
                                    @break
                                <?php else: ?>
                                <?php endif; ?>
                            @endforeach
                        </div>
                    </div>
                    <!--<a href='/create'>chat書き込み</a>-->
                    <div class="footer">
                        <a href="/">homeへ戻る</a>
                    </div>
                </div>
                <div class="user_comment detail-right">
                    <h3>{{$comment->user->name}}の最新コメント</h3>
                    @foreach($latest_comments as $latest)
                        <p>{{$latest->body}}</p>
                        <p>日時：{{$latest->created_at}}</p>
                    @endforeach
                </div>
            </div>
            <!--steam API-->
            <div class="steam-news">
                <?php $apex_newscount = 1; ?>
                <?php $pubg_newscount = 1; ?>
                <h3>ゲーム最新ニュース</h3>
                <p>Apex Legends</p>
                @foreach($apex_newses as $apex_news)
                    <!--news最新3件表示-->
                    <?php if($apex_newscount <= 3):?>
                        <div class="news">
                            <a href = "{{$apex_news['url']}}">{{$apex_news['title']}}</a>
                            <p>日時：{{ date('Y/m/d', $apex_news['date']) }}</p>
                            <?php $apex_newscount += 1; ?>
                        </div>
                    <?php endif; ?>
                @endforeach
                <p>PUBG</p>
                @foreach($pubg_newses as $pubg_news)
                    <!--news最新3件表示-->
                    <?php if($pubg_newscount <= 3):?>
                        <div class="news">
                            <a href = "{{$pubg_news['url']}}">{{$pubg_news['title']}}</a>
                            <p>日時：{{ date('Y/m/d', $pubg_news['date']) }}</p>
                            <?php $pubg_newscount += 1; ?>
                        </div>
                    <?php endif; ?>
                @endforeach
            </div>
        </div>
        
    </body>
</html>

@endsection