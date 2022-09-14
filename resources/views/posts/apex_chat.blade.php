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
            Apex Legends：{{$apex->rank}}帯掲示板
        </h1>
        
        <div class="contents">
            <div class="content__post">
                <?php $reply_num = 0; ?>
                @foreach($comments as $comment)
                    <?php if ($comment->game_id == 1) : ?>
                        <p>コメント：{{$comment->body}}</p>
                        <?php if(($comment->user->name) == (Auth::user()->name)) :?>
                            <a href="/posts/mypage">user：{{$comment->user->name}}</a>
                        <?php else: ?>
                            <a href="/posts_userpage/{{$comment->id}}">user：{{$comment->user->name}}</a><br>
            　　          <?php endif; ?>
                        
                        <br>
                        <p>日時：{{$comment->updated_at}}</p>
                        
                        <!--リプライ数カウント-->
                        <div class="count_reply">
                            <?php $reply_count = 0; ?>
                            @foreach($replies as $reply)
                                <?php 
                                    if ($reply->comment_id == $comment->id) : 
                                        $reply_count+=1;
                                ?>
                                <?php else: ?>
                    　　          <?php endif; ?>
                            @endforeach
                        </div>
                        
                        <!--いいね数カウント-->
                        <div class="count_like">
                            <?php $like_count=0; ?>
                            @foreach($likes as $like)
                                <?php
                                    if ($like->comment_id == $comment->id):
                                        $like_count+=1;
                                ?>
                                <?php else: ?>
                                <?php endif; ?>
                            @endforeach
                        </div>

                        <!--likeフォーム-->
                        <div class="likes">
                            <?php $like_display = 0; ?>
                            <?php if((Auth::user()->id) != ($comment->user_id)) : ?>
                                @foreach($likes as $like)
                                    <?php if((($like->comment_id) == ($comment->id)) && (($like->user_id) == (Auth::user()->id))) : ?>
                                        <?php $like_display = 1; ?>
                                        <form action="/posts_like/{{$like->id}}" id="form_{{$like->id}}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="like_button">♥{{$like_count}}</button>
                                        </form>
                                        @break
                                    <?php else: ?>
                    　　              <?php endif; ?>
                    　　          @endforeach
    
                    　　          <?php if($like_display==0):?>
                    　　          　  <div class="like">
                                        <form action="/posts_like" method="POST">
                                            @csrf
                                            <div class="body">
                                                <div class="user_id">
                                                    <input type ="hidden" name = "likes[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                                                    <p class="user_id_error" style="color:red">{{ $errors->first('likes.user_id') }}</p>
                                                </div>
                                                <div class="comment_id">
                                                    <input type ="hidden" name = "likes[comment_id]" placeholder = "comment_id" value="{{$comment->id}}"/>
                                                    <p class="comment_id__error" style="color:red">{{ $errors->first('likes.comment_id') }}</p>
                                                </div>
                                            </div>
                                            <input type="submit" value="♡{{$like_count}}"/>
                                        </form>
                                    </div>
                                    <?php $like_display = 1; ?>
                    　　          <?php else: ?>
                    　　          <?php endif; ?>
                    　　      <?php else: ?>
                    　　      <?php endif; ?>
                    　　</div>
                    　　
                        <!--replyフォーム-->
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
                                            <input type ="hidden" name = "replies[game_id]" placeholder = "game_id" value="1"/>
                                            <p class="game_id__error" style="color:red">{{ $errors->first('replies.game_id') }}</p>
                                        </div>
                                        <div class="comment_id">
                                            <input type ="hidden" name = "replies[comment_id]" placeholder = "comment_id" value="{{$comment->id}}"/>
                                            <p class="comment_id__error" style="color:red">{{ $errors->first('replies.comment_id') }}</p>
                                        </div>
                                        <div class="body">
                                            <textarea name="replies[body]" placeholder="Apex Comment.">{{old('replies.body')}}</textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                        </div>
                                    </div>
                                    <input type="submit" value="返信"/>
                                </form>
                            </div>
                        </div>
                        
                        <!--reply表示-->
                        <div class="display_reply">
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
                        </div>
                        
                        <p>--------</p>
                　　<?php else: ?>
                　　<?php endif; ?>
                <?php $reply_num +=1; ?>
            　　@endforeach

               <p>-----------------------------------------------------------------------</p>
            </div>
        </div>
        
        <!--コメント書き込みフォーム-->
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
                    <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="1"/>
                    <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                </div>
                <div class="body">
                    <textarea name="comments[body]" placeholder="Apex Comment.">{{old('comments.body')}}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                </div>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection