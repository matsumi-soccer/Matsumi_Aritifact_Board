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
        
        <h1>Game掲示板</h1>
        <div class='posts'>
            <!--<h3 class='game_title'>MyPage</h3>
            
            <div class="my_rank">
                <p class="my_apex_rank">Apexランク：</p>
                <p class="my_valorant_rank">Valorantランク：</p>
                <p class="my_pubg_rank">PUBGランク：</p>
            </div>
            -->
            
            <div class='post'>
                <!--apexchat欄-->
                <div class="apexs">
                    <h3>GameTitle：Apex Legensds</h3>
                   @foreach ($apex as $apex) 
                        <div class="apex_rank">
                            <p class="rank_chat">
                                <a href="/apex/{{$apex->id}}">{{$apex->rank}}</a>
                            </p>
                        </div>
                    @endforeach
                </div>
                
                <!--valorantchat欄-->
                <div class="valorants">
                    <h3>GameTitle：Valorant</h3>
                    
                    @foreach ($valorant as $valorant) 
                        <div class="valorant_rank">
                            <p class="rank_chat">
                                <a href="/valorant/{{$valorant->id}}">{{$valorant->rank}}</a>
                            </p>
                        </div>
                    @endforeach
                </div>
                
                <!--PUBGchat欄-->
                <div class="pubgs">
                    <h3>GameTitle：PUBG</h3>
                    @foreach ($pubg as $pubg) 
                        <p class="rank_chat">
                                <a href="/pubg/{{$pubg->id}}">{{$pubg->rank}}</a>
                            </p>
                    @endforeach
                </div>
                
            </div>
        </div>
        
        <div class='paginate'>
            {{$comments->links()}}
        </div>
    </body>
</html>

@endsection