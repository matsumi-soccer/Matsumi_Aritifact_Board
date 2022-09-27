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
            <?php if($valorant->rank == 'free'):?>
                <p>Valorant：{{$valorant->rank}}chat</p>
            <?php else: ?>
                <p>Valorant：{{$valorant->rank}}帯掲示板</p>
            <?php endif; ?>
        </h1>
        
        <div class="contents">
            <div class="content__post">
                <?php $reply_num = 0; ?>
                @foreach($comments as $comment)
                    <!--freechat-->
                    <?php if(($comment->game_id == 2) && ($valorant->id == 10)):?>
                        <div class="free_chat">
                        <p>コメント：{{$comment->body}}</p>
                        <?php if(($comment->user->name) == (Auth::user()->name)) :?>
                            <a href="/posts/mypage">user：{{$comment->user->name}}</a>
                        <?php else: ?>
                            <a href="/posts_userpage/{{$comment->id}}">user：{{$comment->user->name}}</a><br>
            　　          <?php endif; ?>
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
                        
                        <!--newいいね機能-->
                    　　<div class="row justify-content-center">
                            <like-component
                                :comment="{{ json_encode($comment)}}"
                            ></like-component>
                        </div>
                    　　
                    　　<!--replyフォーム-->
                        <div class="reply">
                            <?php if(Auth::user()->valorant_rank >= ($comment->user->valorant_rank)):?>
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
                                            <input type ="hidden" name = "replies[game_id]" placeholder = "game_id" value="2"/>
                                            <p class="game_id__error" style="color:red">{{ $errors->first('replies.game_id') }}</p>
                                        </div>
                                        <div class="comment_id">
                                            <input type ="hidden" name = "replies[comment_id]" placeholder = "comment_id" value="{{$comment->id}}"/>
                                            <p class="comment_id__error" style="color:red">{{ $errors->first('replies.comment_id') }}</p>
                                        </div>
                                        <div class="body">
                                            <textarea name="replies[body]" placeholder="Valor Comment.">{{old('replies.body')}}</textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                        </div>
                                    </div>
                                    <input type="submit" value="返信"/>
                                </form>
                            </div>
                        </div>
                            <?php else:?>
                            <?php endif;?>
                        </div>
                    　　
                    　  <!--reply表示ここから-->
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
                    </div>    
                    <!--freechat以外-->
                    <?php elseif (($comment->game_id == 2) && (($comment->user->valorant_rank) <= ($valorant->id))): ?>
                        <div class="rank_chat">
                            <p>コメント：{{$comment->body}}</p>
                            <?php if(($comment->user->name) == (Auth::user()->name)) :?>
                                <a href="/posts/mypage">user：{{$comment->user->name}}</a>
                            <?php else: ?>
                                <a href="/posts_userpage/{{$comment->id}}">user：{{$comment->user->name}}</a><br>
                　　          <?php endif; ?>
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
                            
                            <!--newいいね機能-->
                        　　<div class="row justify-content-center">
                                <like-component
                                    :comment="{{ json_encode($comment)}}"
                                ></like-component>
                            </div>
                            
                            
                            <!--replyフォーム-->
                            <div class="reply">
                                <?php if(Auth::user()->valorant_rank <= ($valorant->id)):?>
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
                                                <input type ="hidden" name = "replies[game_id]" placeholder = "game_id" value="2"/>
                                                <p class="game_id__error" style="color:red">{{ $errors->first('replies.game_id') }}</p>
                                            </div>
                                            <div class="comment_id">
                                                <input type ="hidden" name = "replies[comment_id]" placeholder = "comment_id" value="{{$comment->id}}"/>
                                                <p class="comment_id__error" style="color:red">{{ $errors->first('replies.comment_id') }}</p>
                                            </div>
                                            <div class="body">
                                                <textarea name="replies[body]" placeholder="Valor Comment.">{{old('replies.body')}}</textarea>
                                                <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                            </div>
                                        </div>
                                        <input type="submit" value="返信"/>
                                    </form>
                                </div>
                            </div>
                                <?php else:?>
                                <?php endif;?>
                            </div>
                            
                            <!--reply表示ここから-->
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
                        </div>
                　　<?php else: ?>
                　　<?php endif; ?>
                <?php $reply_num +=1; ?>
            　　@endforeach

               <p>-----------------------------------------------------------------------</p>
            </div>
        </div>
        
        <!--コメント書き込みフォーム-->
        <div class="comment">
            <?php if((Auth::user()->valorant_rank == 100) && ($valorant->id == 10)):?>
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
                        <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="2"/>
                        <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                    </div>
                    <div class="body">
                        <textarea name="comments[body]" placeholder="Valorant Comment.">{{old('comments.body')}}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                    </div>
                </div>
                <input type="submit" value="保存"/>
            </form>
            <?php elseif(Auth::user()->valorant_rank <= ($valorant->id)):?>
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
                        <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="2"/>
                        <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                    </div>
                    <div class="body">
                        <textarea name="comments[body]" placeholder="Valorant Comment.">{{old('comments.body')}}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                    </div>
                </div>
                <input type="submit" value="保存"/>
            </form>
            <?php else:?>
                <p>あなたのランクではこの掲示板にはコメントできません</p>
            <?php endif;?>
        </div>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>

@endsection