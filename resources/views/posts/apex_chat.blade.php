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
        <div class="chat-body">
            <h2 class="title">
                <?php if($apex->rank == 'free'):?>
                    <p>Apex Legends：{{$apex->rank}}chat</p>
                <?php else: ?>
                    <p>Apex Legends：{{$apex->rank}}帯掲示板</p>
                <?php endif; ?>
            </h2>
            
            <div class="contents-body">
                <div class="contents">
                    <div class="content__post">
                        <?php $reply_num = 0; ?>
                        @foreach($comments as $comment)
                            <!--freechat-->
                            <?php if(($comment->game_id == 1) && ($apex->id == 9)):?>
                                <div class="rank-chat">
                                
                                    <?php if(($comment->user->name) == (Auth::user()->name)) :?>
                                        <a href="/posts/mypage">{{$comment->user->name}}</a>
                                    <?php else: ?>
                                        <a href="/posts_userpage/{{$comment->id}}">{{$comment->user->name}}</a>
                        　　          <?php endif; ?>
                        　　          <p class="reply-bottom">{{$comment->body}}</p>
                                    <p class="reply-bottom">{{$comment->created_at}}</p>
                                    <?php if($comment->profile_image != NULL) :?>
                                        <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                            <img src = "{{asset('storage/profiles/'.$comment->profile_image)}}" alt="画像" width="150" height="150">
                                        <?php else:?>
                                            <img src="https://s3.ap-northeast-1.amazonaws.com/matsu-backet/{{$comment->profile_image}}"　alt="プロフィール画像"　width="150" height="150">
                                        <?php endif;?>
                                    <?php endif;?>
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
                                        <?php if(Auth::user()->apex_rank >= ($comment->user->apex_rank)):?>
                                            <div class="wrap reply-btn">
                                                <label for="label_reply{{$reply_num}}" class="btn btn-info">reply</label>
                                                <input type="checkbox" id="label_reply{{$reply_num}}" class="switch_reply" />
                                                <div class="reply-content">
                                                    <form action="/posts_reply" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="body">
                                                            <div class="user_id">
                                                                <p>投稿者「{{Auth::user()->name}}」</p>
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
                                                                <textarea name="replies[body]" placeholder="Apex Comment." cols="50" rows="5">{{old('replies.body')}}</textarea>
                                                                <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                                            </div>
                                                            <div class="reply_image">
                                                                <p>画像をアップロード</p>
                                                                <input type="file" name="replies[reply_image]">
                                                                <p class="image__error" style="color:red">{{ $errors->first('replies.reply_image') }}</p>
                                                            </div> 
                                                        </div>
                                                        <input type="submit" value="送信"/>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php else:?>
                                        <?php endif;?>
                                    </div>
                                　　
                                　　<!--reply表示-->
                                    <div class="display_reply">
                                        <?php if($reply_count > 0):?>
                                            <div class="wrap">
                                                <label for="label{{$comment->id}}">コメント{{$reply_count}}件をすべて表示</label>
                                                <input type="checkbox" id="label{{$comment->id}}" class="switch" />
                                                <!--隠すコンテンツ -->
                                                <div class="reply-content">
                                                    @foreach($replies as $reply)
                                                        <?php if ($reply->comment_id == $comment->id):?>
                                                            <div class="reply">
                                                                <p class="padding-bottom">{{$reply->user->name}}：{{$reply->body}}</p>
                                                                <p class="padding-bottom">{{$reply->created_at}}</p>
                                                                <?php if($reply->reply_image != NULL) :?>
                                                                     <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                                                        <img src = "{{asset('storage/profiles/'.$reply->reply_image)}}" alt="画像" width="150" height="150">
                                                                    <?php else:?>
                                                                        <img src="https://s3.ap-northeast-1.amazonaws.com/matsu-backet/{{$reply->reply_image}}"　alt="プロフィール画像"　width="150" height="150">
                                                                    <?php endif;?>
                                                                <?php endif;?>
                                                            </div>
                                                        <?php else: ?>
                                            　　          <?php endif; ?>
                                                    @endforeach
                                                </div>
                                                <!--隠すコンテンツ-->
                                            </div>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            <!--freechat以外-->
                            <?php elseif (($comment->game_id == 1) &&  (($comment->user->apex_rank) <= ($apex->id))): ?>
                                <div class="rank-chat">
                                    <?php if(($comment->user->name) == (Auth::user()->name)) :?>
                                        <a href="/posts/mypage">{{$comment->user->name}}</a>
                                    <?php else: ?>
                                        <a href="/posts_userpage/{{$comment->id}}">{{$comment->user->name}}</a>
                        　　          <?php endif; ?>
                                    <p class="padding-bottom">{{$comment->body}}</p>
                                    
                                    <p class="padding-bottom">{{$comment->created_at}}</p>
                                    <?php if($comment->profile_image != NULL) :?>
                                        <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                            <p>開発</p>
                                            <img src = "{{asset('storage/profiles/'.$comment->profile_image)}}" alt="画像" width="150" height="150">
                                        <?php else:?>
                                            <p>本番</p>
                                            <img src="https://s3.ap-northeast-1.amazonaws.com/matsu-backet/{{$comment->profile_image}}"　alt="画像"　width="150" height="150">
                                        <?php endif;?>
                                    <?php endif;?>
                                    
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
                                        <?php if(Auth::user()->apex_rank <= ($apex->id)):?>
                                            <div class="wrap reply-btn">
                                            <label for="label_reply{{$reply_num}}" class="btn btn-info">reply</label>
                                            <input type="checkbox" id="label_reply{{$reply_num}}" class="switch_reply" />
                                            <div class="reply-content">
                                                <form action="/posts_reply" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="body">
                                                        <div class="user_id">
                                                            <p>投稿者「{{Auth::user()->name}}」</p>
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
                                                            <textarea name="replies[body]" placeholder="Apex Comment."cols="50" rows="5">{{old('replies.body')}}</textarea>
                                                            <p class="body__error" style="color:red">{{ $errors->first('replies.body') }}</p>
                                                        </div>
                                                        <div class="reply_image">
                                                            <p>画像をアップロード</p>
                                                            <input type="file" name="replies[reply_image]">
                                                            <p class="image__error" style="color:red">{{ $errors->first('replies.reply_image') }}</p>
                                                        </div> 
                                                    </div>
                                                    <input type="submit" value="送信"/>
                                                </form>
                                            </div>
                                        </div>
                                        <?php else:?>
                                        <?php endif;?>
                                    </div>
                                    
                                    <!--reply表示-->
                                    <div class="display_reply">
                                        <?php if($reply_count > 0):?>
                                            <div class="wrap">
                                                <label for="label{{$comment->id}}">コメント{{$reply_count}}件をすべて表示</label>
                                                <input type="checkbox" id="label{{$comment->id}}" class="switch" />
                                                <!--隠すコンテンツ -->
                                                <div class="reply-content">
                                                    @foreach($replies as $reply)
                                                        <?php if ($reply->comment_id == $comment->id):?>
                                                            <div class="reply">
                                                                <p class="padding-bottom">{{$reply->user->name}}：{{$reply->body}}</p>
                                                                <p class="padding-bottom">{{$reply->created_at}}</p>
                                                                <?php if($reply->reply_image != NULL) :?>
                                                                    <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                                                        <img src = "{{asset('storage/profiles/'.$reply->reply_image)}}" alt="画像" width="150" height="150">
                                                                    <?php else:?>
                                                                        <img src="https://s3.ap-northeast-1.amazonaws.com/matsu-backet/{{$reply->reply_image}}"　alt="プロフィール画像"　width="150" height="150">
                                                                    <?php endif;?>
                                                                <?php endif;?>
                                                            </div>
                                                        <?php else: ?>
                                            　　          <?php endif; ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        　　<?php else: ?>
                        　　<?php endif; ?>
                        <?php $reply_num +=1; ?>
                    　　@endforeach
                    </div>
                    <div class='paginate'>
                        {{$comments->links()}}
                    </div>
                </div>
                
                <!--コメント書き込みフォーム-->
                <div class="comment">
                    <?php if((Auth::user()->apex_rank == 100) && ($apex->id == 9)):?>
                        <form action="/posts" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="body">
                            <h3>comment書き込み</h3>
                            <div class="user_id">
                                <p>投稿者「{{Auth::user()->name}}」</p>
                                <input type ="hidden" name = "comments[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                                <p class="user_id__error" style="color:red">{{ $errors->first('comments.user_id') }}</p>
                            </div>
                            <div class="game_id">
                                <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="1"/>
                                <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                            </div>
                            <div class="body">
                                <textarea name="comments[body]" placeholder="Apex Comment."　cols="60" rows="6">{{old('comments.body')}}</textarea>
                                <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                            </div>
                            <div class="profile_image">
                                <p>画像をアップロード</p>
                                <input type="file" name="comments[profile_image]">
                                <p class="image__error" style="color:red">{{ $errors->first('comments.profile_image') }}</p>
                            </div> 
                        </div>
                        <input type="submit" value="投稿"/>
                    </form>
                    <?php elseif(Auth::user()->apex_rank <= ($apex->id)):?>
                        <form action="/posts" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="body">
                            <h3>comment書き込み</h3>
                            <div class="user_id">
                                <p>投稿者「{{Auth::user()->name}}」</p>
                                <input type ="hidden" name = "comments[user_id]" placeholder = "user_id" value="{{Auth::user()->id}}"/>
                                <p class="user_id__error" style="color:red">{{ $errors->first('comments.user_id') }}</p>
                            </div>
                            <div class="game_id">
                                <input type ="hidden" name = "comments[game_id]" placeholder = "game_id" value="1"/>
                                <p class="game_id__error" style="color:red">{{ $errors->first('comments.game_id') }}</p>
                            </div>
                            <div class="body">
                                <textarea name="comments[body]" placeholder="Apex Comment."　cols="60" rows="6">{{old('comments.body')}}</textarea>
                                <p class="body__error" style="color:red">{{ $errors->first('comments.body') }}</p>
                            </div>
                            <div class="profile_image">
                                <p>画像をアップロード</p>
                                <input type="file" name="comments[profile_image]">
                                <p class="image__error" style="color:red">{{ $errors->first('comments.profile_image') }}</p>
                            </div> 
                        </div>
                        <input type="submit" value="投稿"/>
                        </form>
                    <?php else:?>
                        <p>あなたのランクではこの掲示板にはコメントできません</p>
                    <?php endif;?>
                </div>
                    
                <div class="footer">
                    <a href="/">homeへ戻る</a>
                </div>
            </div>
        </div>
    </body>
</html>

@endsection