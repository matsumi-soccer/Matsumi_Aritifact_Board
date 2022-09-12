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
        <link rel="stylesheet" href="/css/chat.css">
    </head>
    <body>
        <p>User：{{Auth::user()->name}}</P>
        <p class ="mypage"><a href="/posts/mypage">MyPage</a></p>
        
        <h1 class="title">
            PLAYERUNKNOWN'S BATTLEGROUNDS：{{$pubg->rank}}帯掲示板
        </h1>
        
        <div class="contents">
            <div class="content__post">
                <?php $reply_num = 0; ?>
                @foreach($comments as $comment)
                    <?php if ($comment->game_id == 3) : ?>
                        <p>コメント：{{$comment->body}}</p>
                        <p>user：{{$comment->user->name}}</p>
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
            　　          <!--follow機能　ここまで--
                        
                        <p>日時：{{$comment->updated_at}}</p>
                        <?php $reply_count = 0; ?>
                        @foreach($replies as $reply)
                            <?php 
                                if ($reply->comment_id == $comment->id) : 
                                    $reply_count+=1;
                            ?>
                            <?php else: ?>
                　　          <?php endif; ?>
                        @endforeach
                        
                        <!--reply-->
                        <div class="wrap">
                            <label for="label_reply{{$reply_num}}">返信</label>
                            <input type="checkbox" id="label_reply{{$reply_num}}" class="switch_reply" />
                            <div class="content">
                                <form action="/posts_reply" method="POST">
                                    @csrf
                                    <div class="body">
                                        <h2>reply</h2>
                                        <div class="user_id">
                                            <p>リプライ投稿者:{{Auth::user()->name}}</p>
                                            <input type ="hidden" name = "replies[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                                            <p class="user_id__error" style="color:red">{{ $errors->first('replies.user_id') }}</p>
                                        </div>
                                        <div class="game_id">
                                            <input type ="hidden" name = "replies[game_id]" placeholder = "game_id" value="3"/>
                                            <p class="game_id__error" style="color:red">{{ $errors->first('replies.game_id') }}</p>
                                        </div>
                                        <div class="comment_id">
                                            <input type ="hidden" name = "replies[comment_id]" placeholder = "comment_id" value="{{$comment->id}}"/>
                                            <p class="comment_id__error" style="color:red">{{ $errors->first('replies.comment_id') }}</p>
                                        </div>
                                        <div class="body">
                                            <textarea name="replies[body]" placeholder="PUBG Comment.">{{old('replies.body')}}</textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                        </div>
                                    </div>
                                    <input type="submit" value="返信"/>
                                </form>
                            </div>
                        </div>
                        <!-- reply -->
                        
                        
                        <!--reply表示ここから-->
                        <?php if($reply_count > 0):?>
                            <div class="wrap">
                                <label for="label{{$comment->id}}">▼ {{$reply_count}}件の返信</label>
                                <input type="checkbox" id="label{{$comment->id}}" class="switch" />
                                <!--隠すコンテンツ -->
                                <div class="content">
                                    @foreach($replies as $reply)
                                        <?php if ($reply->comment_id == $comment->id):?>
                                            <p>{{$reply->user->name}}:{{$reply->body}}</p>
                                        <?php else: ?>
                            　　          <?php endif; ?>
                                    @endforeach
                                </div>
                                <!--隠すコンテンツ-->
                            </div>
                        <?php else: ?>
                        <?php endif; ?>
                        <!--ここまで-->
                        <p>--------</p>
                　　<?php else: ?>
                　　<?php endif; ?>
                <?php $reply_num +=1; ?>
            　　@endforeach

               <p>-----------------------------------------------------------------------</p>
            </div>
        </div>
        
         <form action="/posts" method="POST">
            @csrf
            <div class="body">
                <h2>comment書き込み</h2>
                <div class="user_id">
                    <p>コメント投稿者：{{Auth::user()->name}}</p>
                    <input type ="hidden" name = "comments[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                    <p class="user_id__error" style="color:red">{{ $errors->first('comments.user_id') }}</p>
                </div>
                <div class="game_id">
                    <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="3"/>
                    <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                </div>
                <div class="body">
                    <textarea name="comments[body]" placeholder="PUBG Comment.">{{old('comments.body')}}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                </div>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection