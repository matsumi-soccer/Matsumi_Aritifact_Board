@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
        <link rel="stylesheet" href="/css/detail.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="search-body">
            <div class="results">
                <div class="result-comment">
                    <h2>コメントの検索結果</h2>
                    @foreach($comments as $comment)
                            <div class="content">
                                <p class="padding-bottom name">{{$comment->user->name}}</p>
                                <p class="padding-bottom">コメント：{{$comment->body}}</p>
                                <p class="padding-bottom">{{$comment->created_at->format('Y/m/d h:m')}}</p>
                            </div>
                    @endforeach
                    <div class='paginate'>
                        {{$comments->links()}}
                    </div>
                </div>
                
                <!--<div class="result-reply">-->
                <!--    <h2>リプライの検索結果</h2>-->
                <!--    @foreach($replies as $reply)-->
                <!--        <div class="content">-->
                <!--            <p class="padding-bottom name">{{$reply->user->name}}</p>-->
                <!--            <p class="padding-bottom">リプライ：{{$reply->body}}</p>-->
                <!--            <p class="padding-bottom">{{$reply->updated_at}}</p>-->
                <!--        </div>-->
                <!--    @endforeach-->
                <!--    <div class='paginate'>-->
                <!--        {{$replies->links()}}-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <!--steam API-->
            <div class="steam-news">
                <?php $apex_newscount = 1; ?>
                <?php $pubg_newscount = 1; ?>
                <h3>ゲーム最新ニュース</h3>
                <p class="game-title">Apex Legends</p>
                @foreach($apex_newses as $apex_news)
                    <!--news最新3件表示-->
                    <?php if($apex_newscount <= 3):?>
                        <div class="news">
                            <a href = "{{$apex_news['url']}}">{{$apex_news['title']}}</a>
                            <p>日時：{{ date('Y/m/d h:m', $apex_news['date']) }}</p>
                            <?php $apex_newscount += 1; ?>
                        </div>
                    <?php endif; ?>
                @endforeach
                <p class="game-title">PUBG</p>
                @foreach($pubg_newses as $pubg_news)
                    <!--news最新3件表示-->
                    <?php if($pubg_newscount <= 3):?>
                        <div class="news">
                            <a href = "{{$pubg_news['url']}}">{{$pubg_news['title']}}</a>
                            <p>日時：{{ date('Y/m/d h:m', $pubg_news['date']) }}</p>
                            <?php $pubg_newscount += 1; ?>
                        </div>
                    <?php endif; ?>
                @endforeach
            </div>
            
        </div>
        
        <div class="footer">
            <a href="/">homeへ戻る</a>
        </div>
    </body>
</html>

@endsection