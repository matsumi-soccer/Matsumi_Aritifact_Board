@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MyPage</title>
        <link rel="stylesheet" href="/css/userpage.css">
    </head>
    <body>
        <div class="userpage-body">
            <!--左サイドバー-->
            <div class="my-detail userpage-flex">
                <div class="basic-profile">
                    <h3 class="user-name">{{Auth::user()->name}}</h3>
                    <!--user情報変更-->
                    <div class="profile_edit"><button class="btn btn-light"><a href="/profile/{{Auth::user()->id}}/edit">プロフィール情報編集</a></button></div>
                    <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                        <img src = "{{asset('storage/profiles/'.Auth::user()->profile_image)}}" class="profile_image" alt="プロフィール画像" width="150" height="150">
                    <?php else:?>
                        <?php if((Auth::user()->profile_image) == "game.png") :?>
                            <img src="https://matsu-backet.s3.ap-northeast-1.amazonaws.com/dEneYPp9hWOaOs7oawHbCTZN0YxYNy4gsd6UkHri.jpg" class="profile_image" alt="プロフィール画像"　width="150" height="150">
                        <?php else:?>
                            <img src="https://matsu-backet.s3.ap-northeast-1.amazonaws.com/{{Auth::user()->profile_image}}"　class="profile_image" alt="プロフィール画像"　width="150" height="150">
                        <?php endif;?>
                        <!--<img src="https://s3.ap-northeast-1.amazonaws.com/matsu-backet/{{Auth::user()->profile_image}}"　alt="プロフィール画像"　width="150" height="150">-->
                        
                    <?php endif;?>
                    <form action="{{ route('add_image') }}" enctype='multipart/form-data' method ="POST">
                      @csrf
                        <input type="file" name="image">
                        <p><input type="submit" value="アイコン変更"></p>
                    </form>
                </div>
                
                <!--my_gamerank-->
                <div class="my-rank">
                    <h3 class="title">GameRank</h3>
                    <div class="my_apexrank">
                            @foreach($apexes as $apex)
                                <?php if((Auth::user()->apex_rank) == 100): ?>
                                    <p>Apex Legends：unlanked</p>
                                    @break
                                <?php elseif(($apex->id)==(Auth::user()->apex_rank)): ?>
                                    <p>Apex Legends：{{$apex->rank}}</p>
                                <?php else: ?>
                                <?php endif; ?>
                            @endforeach
                        </div>
                    <div class="my_valorantrank">
                        @foreach($valorants as $valorant)
                            <?php if((Auth::user()->valorant_rank) == 100): ?>
                                <p>Valorant：unlanked</p>
                                @break
                            <?php elseif(($valorant->id)==(Auth::user()->valorant_rank)): ?>
                                <p>Valorant：{{$valorant->rank}}</p>
                            <?php else: ?>
                            <?php endif; ?>
                        @endforeach
                    </div>
                    <div class="my_pubgrank">
                        @foreach($pubgs as $pubg)
                            <?php if((Auth::user()->pubg_rank) == 100): ?>
                                <p>PUBG：unlanked</p>
                                @break
                            <?php elseif(($pubg->id)==(Auth::user()->pubg_rank)): ?>
                                <p>PUBG：{{$pubg->rank}}</p>
                            <?php else: ?>
                            <?php endif; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--コメント一覧-->
            <div class="pasts userpage-flex">
                <!--過去のコメント-->
                <div class="chatteds">
                    <h2 class="commented">過去のコメント一覧</h2>
                     @foreach ($comments as $comment) 
                        <div class="chatted">
                            <?php if ($comment->user_id == Auth::user()->id) : ?>
                                <div class="past-comment">
                                    <p class="past-name">{{$comment->user->name}}</p>
                                    <p>{{$comment->body}}</p>
                                    <div class="edit-date">
                                        <p>投稿：{{$comment->created_at->format('Y/m/d h:m')}}</p>
                                        <p>更新：{{$comment->updated_at->format('Y/m/d h:m')}}</p>
                                    </div>
                                    <?php if($comment->profile_image != NULL) :?>
                                        <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                            <img src = "{{asset('storage/profiles/'.$comment->profile_image)}}" alt="画像" width="150" height="150">
                                        <?php else:?>
                                            <img src="{{$comment->profile_image}}"　alt="画像"　width="150" height="150">
                                        <?php endif;?>
                                    <?php endif;?>
                                    <!--コメント編集・削除-->
                                    <div class="comment-edit">
                                        <div class="edit"><button class="btn btn-info"><a href="/posts/{{$comment->id}}/edit">編集</a></button></div>
                                        <div class="comment-delete">
                                            <script type="text/javascript">
                                                function delete_alert(e){
                                                   if(!window.confirm('本当に削除しますか？')){
                                                      window.alert('キャンセルされました'); 
                                                      return false;
                                                   }
                                                   document.deleteform.submit();
                                                };
                                            </script>
                                            <form action="/posts/{{$comment->id}}" id="form_{{$comment->id}}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onClick="delete_alert(event);return false;" class="btn btn-danger">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        　　<?php else: ?>
                        　　<?php endif; ?>
                        </div>
                    @endforeach
                </div>
                
                <!--過去のリプライ-->
                <div class="replieds">
                    <h2 class="replied">過去のリプライ一覧</h2>
                    @foreach ($replies as $reply) 
                        <div class="replied">
                            <?php if ($reply->user_id == Auth::user()->id) : ?>
                                <div class="past-comment">
                                    <p class="past-name">{{$reply->user->name}}</p>
                                    <p>{{$reply->body}}</p>
                                    <div class="edit-date">
                                        <p>投稿：{{$reply->created_at->format('Y/m/d h:m')}}</p>
                                        <p>更新：{{$reply->updated_at->format('Y/m/d h:m')}}</p>
                                    </div>
                                    <?php if($reply->reply_image != NULL) :?>
                                        <?php if( app()->isLocal()|| app()->runningUnitTests()):?>
                                            <img src = "{{asset('storage/profiles/'.$reply->reply_image)}}" alt="画像" width="150" height="150">
                                        <?php else:?>
                                            <img src="{{$reply->reply_image}}"　alt="画像"　width="150" height="150">
                                        <?php endif;?>
                                    <?php endif;?>
                                    <div class="comment-edit"> 
                                        <div class="edit"><button class="btn btn-info"><a href="/posts/reply/{{$reply->id}}/edit">編集</a></button></div>
                                        <div class="comment-delete">
                                            <form action="/posts/reply/{{$reply->id}}" id="form_{{$reply->id}}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onClick="delete_alert(event);return false;"  class="btn btn-danger">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        　　<?php else: ?>
                        　　<?php endif; ?>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        
        <div class="footer">
            <a href="/">homeへ戻る</a>
        </div>
    </body>
    
</html>
@endsection