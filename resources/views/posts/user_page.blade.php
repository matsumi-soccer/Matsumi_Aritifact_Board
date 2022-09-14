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
    
        <h1>User：{{$comment->user->name}}</h1>
        <!--follow機能 $follow_display=0:フォロー, 1:フォロー解除-->
        <!--follow解除-->
        <?php $follow_display = 0; ?>
        <?php if((Auth::user()->id) != ($comment->user_id)) : ?>
            @foreach($follows as $follow)
                <?php if((($follow->followed_id) == ($comment->user_id)) && (($follow->following_id) == (Auth::user()->id))) : ?>
                    <?php $follow_display = 1; ?>
                    <form action="/posts_follow/{{$follow->id}}" id="form_{{$follow->id}}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">フォロー解除</button>
                    </form>
                    @break
                <?php else: ?>
　　            <?php endif; ?>
　　          @endforeach
　　          <!--follow-->
　　          <?php if($follow_display==0):?>
　　            <div class="follow">
                    <form action="/posts_follow" method="POST">
                        @csrf
                        <div class="body">
                            <div class="following_id">
                                <input type ="hidden" name = "follows[following_id]" placeholder = "following_id" value="{{Auth::user()->id}}"/>
                                <p class="following_id__error" style="color:red">{{ $errors->first('follows.following_id') }}</p>
                            </div>
                            <div class="followed_id">
                                <input type ="hidden" name = "follows[followed_id]" placeholder = "followed_id" value="{{$comment->user_id}}"/>
                                <p class="followed_id__error" style="color:red">{{ $errors->first('follows.followed_id') }}</p>
                            </div>
                        </div>
                        <input type="submit" value="フォロー"/>
                    </form>
                </div>
                <?php $follow_display = 1; ?>
　　           <?php else: ?>
　　           <?php endif; ?>
    　　          
        <?php else: ?>
　　    <?php endif; ?>
　　    <!--follow機能　ここまで-->
        
        <div class='posts'>
            <h2 class="title">Game Rank</h2>
            <p>Apex Legends：{{$comment->user->apex_rank}}</p>
            <p>Valorant：{{$comment->user->valorant_rank}}</p>
            <p>PUBG：{{$comment->user->pubg_rank}}</p>
            <p>-----------------------------------------------------------------------</p>
            
           
                
        </div>
        
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection