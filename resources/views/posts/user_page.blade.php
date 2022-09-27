@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    </head>
    <body>
        <h1>User：{{$comment->user->name}}</h1>

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
            <div class="row justify-content-center">
                <follow-component
                    :user = "{{ json_encode($comment->user) }}"
                    :default-Followed = "{{ json_encode($defaultFollowed) }}"
                    :default-Count = "{{ json_encode($defaultCount) }}"
                ></follow-component>
            </div>
        </div>

        <!--ゲームランク表示-->
        <div class='posts'>
            <h2 class="title">Game Rank</h2>
            
            <div class="my_apexrank">
                @foreach($apexes as $apex)
                    <?php if(($apex->id)==($comment->user->apex_rank)): ?>
                        <p>Apex Legends：{{$apex->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>
            <div class="my_valorantrank">
                @foreach($valorants as $valorant)
                    <?php if(($valorant->id)==($comment->user->valorant_rank)): ?>
                        <p>Valorant：{{$valorant->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>
            <div class="my_pubgrank">
                @foreach($pubgs as $pubg)
                    <?php if(($pubg->id)==($comment->user->pubg_rank)): ?>
                        <p>PUBG：{{$pubg->rank}}</p>
                    <?php else: ?>
                    <?php endif; ?>
                @endforeach
            </div>

            <p>-----------------------------------------------------------------------</p>
            
           
                
        </div>
        
        <!--<a href='/create'>chat書き込み</a>-->
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
    </body>
</html>

@endsection