@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
    </head>
    <body>
        <h2 class="title">ログインユーザー：{{Auth::user()->name}}</h2>
        
        <br>
        <h2 class="title">My Rank</h2>

        
        <div class="my_apexrank">
                @foreach($apexes as $apex)
                    <?php if(($apex->id)==(Auth::user()->apex_rank)): ?>
                        <p>Apex Legends：{{$apex->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>
            <div class="my_valorantrank">
                @foreach($valorants as $valorant)
                    <?php if(($valorant->id)==(Auth::user()->valorant_rank)): ?>
                        <p>Valorant：{{$valorant->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>
            <div class="my_pubgrank">
                @foreach($pubgs as $pubg)
                    <?php if(($pubg->id)==(Auth::user()->pubg_rank)): ?>
                        <p>PUBG：{{$pubg->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>
        <p>-----------------------------------------------------------------------</p>
        <br>
        
        <div class="chatted">
            
            <h2 class="commented">過去のコメント一覧</h2>
             @foreach ($comments as $comment) 
                <div class="test">
                    <?php if ($comment->user_id == Auth::user()->id) : ?>
                        <p>コメント：{{$comment->body}}</p>
                        <p>投稿日時：{{$comment->created_at}}</p>
                        <p>更新日時：{{$comment->updated_at}}</p>
                        <p class="edit">[<a href="/posts/{{$comment->id}}/edit">編集</a>]</p>
                        
                        <!--コメント削除-->
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
                            <button type="submit" onClick="delete_alert(event);return false;">削除</button>
                        </form>
                        <p>-----------------------------------------------------------------------</p>
                　　<?php else: ?>
                　　<?php endif; ?>
                </div>
            @endforeach
        </div>
        
        <h2 class="replied">過去のリプライ一覧</h2>
             @foreach ($replies as $reply) 
                <div class="test">
                    <?php if ($reply->user_id == Auth::user()->id) : ?>
                        <p>コメント：{{$reply->body}}</p>
                        <p>投稿日時：{{$reply->created_at}}</p>
                        <p>更新日時：{{$reply->updated_at}}</p>
                        <p class="edit">[<a href="/posts/reply/{{$reply->id}}/edit">編集</a>]</p>
                        
                        <!--リプライ削除-->
                        <form action="/posts/reply/{{$reply->id}}" id="form_{{$reply->id}}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onClick="delete_alert(event);return false;">削除</button>
                        </form>
                        <p>-----------------------------------------------------------------------</p>
                　　<?php else: ?>
                　　<?php endif; ?>
                </div>
            @endforeach
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">homeへ戻る</a>
        </div>
    </body>
    
</html>
@endsection