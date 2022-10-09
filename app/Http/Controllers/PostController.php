<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ReplyRequest;
use App\Http\Requests\FollowRequest;
use App\Http\Requests\LikeRequest;
use App\Comments;
use App\Reply;
use App\Apex;
use App\Valorant;
use App\Pubg;
use App\User;
use App\Follow;
use App\Like;
use App\FollowUser;

class PostController extends Controller
{
    //ホーム画面
    public function index(Comments $comment, Apex $apex, Valorant $valorant, Pubg $pubg, FollowUser $follows, User $user)
    {
        return view('posts/index')->with([
            'comments'=>$comment->get(),
            'apex'=>$apex->select('id', 'rank')->get(),
            'valorant'=>$valorant->select('id', 'rank')->get(),
            'pubg'=>$pubg->select('id', 'rank')->get(),
            'follows'=>$follows->getCountAmount(),
            'users'=> $user->get()
        ]);
    }
    
    //chatページ
    public function apex_chat(Apex $apex, Comments $comment, Reply $reply, Like $like)
    {
        $comment = Comments::where('game_id', '=', 1);
        return view('posts/apex_chat')->with([
            'apex' => $apex,
            'comments' => $comment->orderBy('created_at', 'desc')->paginate(10),
            'replies' => $reply->get(),
            'likes' => $like->get()
        ]);
    }
    
    public function valorant_chat(Valorant $valorant, Comments $comment, Reply $reply, Like $like)
    {
        $comment = Comments::where('game_id', '=', 2);
        return view('posts/valorant_chat')->with([
            'valorant' => $valorant,
            'comments' => $comment->orderBy('created_at', 'desc')->paginate(10),
            'replies' => $reply->get(),
            'likes' => $like->get()
        ]);
    }
    
    public function pubg_chat(Pubg $pubg, Comments $comment,  Reply $reply, Like $like)
    {
        $comment = Comments::where('game_id', '=', 3);
        return view('posts/pubg_chat')->with([
            'pubg' => $pubg,
            'comments' => $comment->orderBy('created_at', 'desc')->paginate(10),
            'replies' => $reply->get(),
            'likes' => $like->get()
        ]);
    }
    
    //コメント作成
    public function create()
    {
        return view('posts/create');
    }
    
    //コメント＆画像保存
    public function store(Request $request, Comments $comment)
    {
        $comment = new Comments;
        $comment->user_id = $request['comments.user_id'];
        $comment->game_id = $request['comments.game_id'];
        $comment->body = $request['comments.body'];
        $comment->save();
        
        //画像の保存
        if($request['comments.profile_image'])
        {
            //開発環境
            if( app()->isLocal()|| app()->runningUnitTests())
            {
                $file_name = $request['comments.profile_image']->getClientOriginalName();
                DB::table('comments')
                ->where('id', $comment->id)
                ->update(['profile_image' => $file_name]);
                if($request['comments.profile_image']->extension() == 'gif' || $request['comments.profile_image']->extension() == 'jpeg' || $request['comments.profile_image']->extension() == 'jpg' || $request['comments.profile_image']->extension() == 'png')
                {
                    $img = $request['comments.profile_image']->storeAs('public/profiles', $file_name);
                }
            }else{
                //本番環境
                $file_name = $request['comments.profile_image'];
                $path = Storage::disk('s3')->putFile('/', $file_name, 'public');
                $comment->profile_image=Storage::disk('s3')->url($path);
                $comment->save();
            }
        }
        return redirect()->back();
    }
    
    //コメント編集画面
    public function edit(Comments $comment)
    {
        return view('posts/edit')->with(['comment' => $comment]);
    }
    
    //コメント更新
    public function update(PostRequest $request, Comments $comment)
    {
        $input_post = $request['comments'];
        $comment->fill($input_post)->save();
    
        return redirect('/posts/mypage');
    }
    
    //コメント削除
    public function delete(Comments $comment)
    {
        $comment->delete();
        return redirect('/posts/mypage');
    }
    
    //リプライ保存
    public function store_reply(Request $request, Reply $reply)
    {
        $reply = new Reply;
        $reply->user_id = $request['replies.user_id'];
        $reply->game_id = $request['replies.game_id'];
        $reply->comment_id = $request['replies.comment_id'];
        $reply->body = $request['replies.body'];
        $reply->save();
        
        //画像の保存
        if($request['replies.reply_image'])
        {
            $file_name = $request['replies.reply_image']->getClientOriginalName();
            DB::table('replies')
            ->where('id', $reply->id)
            ->update(['reply_image' => $file_name]);
            if($request['replies.reply_image']->extension() == 'gif' || $request['replies.reply_image']->extension() == 'jpeg' || $request['replies.reply_image']->extension() == 'jpg' || $request['replies.reply_image']->extension() == 'png')
            {
                $img = $request['replies.reply_image']->storeAs('public/profiles', $file_name);
            }
        }
        
        return redirect()->back();
    }
    
    //リプライ編集
    public function edit_reply(Reply $reply)
    {
        return view('posts/edit_reply')->with(['reply' => $reply]);
    }
    
    //リプライ更新
    public function update_reply(ReplyRequest $request, Reply $reply)
    {
        $input_post = $request['replies'];
        $reply->fill($input_post)->save();
    
        return redirect('/posts/mypage');
    }
    
    //リプライ削除
    public function reply_delete(Reply $reply)
    {
        $reply->delete();
        return redirect('/posts/mypage');
    }
    
    //マイページ画面
    public function mypage(Comments $comment, Reply $reply,Apex $apex, Valorant $valorant, Pubg $pubg)
    {
        return view('posts/mypage')->with([
            'comments' => $comment->get(),
            'replies' => $reply->get(),
            'apexes' => $apex->get(),
            'valorants'=> $valorant->get(),
            'pubgs'=>$pubg->get()
        ]);
    }
    
    //フォロー保存
    public function store_follow(FollowRequest $request, Follow $follow)
    {
        $input = $request['follows'];
        $follow->fill($input)->save();
        return redirect()->back();
    }
    
    //フォロー解除
    public function follow_delete(Follow $follow)
    {
        $follow->forceDelete();
        return redirect()->back();
    }
    
    //いいね保存
    public function store_like(LikeRequest $request, Like $like)
    {
        $input = $request['likes'];
        $like->fill($input)->save();
        return redirect()->back();
    }
    
    //いいね取り消し
    public function like_delete(Like $like)
    {
        $like->forceDelete();
        return redirect()->back();
    }
    
    //ユーザーページ画面
    public function userpage(Comments $comment, Follow $follow, Apex $apex, Valorant $valorant, Pubg $pubg)
    {
        $client = new \GuzzleHttp\Client();
        $apex_url='http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=1172470&format=json';
        $pubg_url='http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=578080&format=json';

        $apex_response = $client->request(
            'GET',
            $apex_url,
            ['Bearer' => config('services.steam.token')]
        );
        $apex_news = json_decode($apex_response->getBody(), true);
        $pubg_response = $client->request(
            'GET',
            $pubg_url,
            ['Bearer' => config('services.steam.token')]
        );
        $pubg_news = json_decode($pubg_response->getBody(), true);
        
        $latest_comment = Comments::where('user_id', '=', $comment->user_id);
        
        return view('posts/user_page')->with([
            'comment' => $comment, 
            'latest_comments' => $latest_comment->orderBy('created_at', 'desc')->paginate(3),
            'apexes' => $apex->get(), 
            'valorants'=> $valorant->get(), 
            'pubgs'=>$pubg->get(),
            'apex_newses' => $apex_news['appnews']['newsitems'],
            'pubg_newses' => $pubg_news['appnews']['newsitems'],
        ]);
    }

    //followerランキング画面
    public function follower_lanking(Comments $comment, FollowUser $followuser)
    {
         return view('posts/follower_lanking')->with([
             'comments' => $comment->get(),
             'follows' => $followuser->getAllCountAmount()
        ]);
    }
    
    //キーワード検索画面
    public function search(Request $request, Comments $comment)
    {
        $comments = Comments::paginate(10);
        $search_comment = $request->input('search');
        $query = Comments::query();
        
        if($search_comment)
        {
            $spaceConversion = mb_convert_kana($search_comment, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value)
            {
                $query->where('body', 'like', '%'.$value.'%');
            }
            $comments=$query->paginate(10);
        }
        
        $replies = Reply::paginate(10);
        $search_reply = $request->input('search');
        $query_reply = Reply::query();
        
        if($search_reply)
        {
            $spaceConversion_reply = mb_convert_kana($search_reply, 's');
            $wordArraySearched_reply = preg_split('/[\s,]+/', $spaceConversion_reply, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched_reply as $value)
            {
                $query_reply->where('body', 'like', '%'.$value.'%');
            }
            $replies=$query->paginate(10);
        }
        
        //steam 
        $client = new \GuzzleHttp\Client();
        $apex_url='http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=1172470&format=json';
        $pubg_url='http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=578080&format=json';

        $apex_response = $client->request(
            'GET',
            $apex_url,
            ['Bearer' => config('services.steam.token')]
        );
        $apex_news = json_decode($apex_response->getBody(), true);
        $pubg_response = $client->request(
            'GET',
            $pubg_url,
            ['Bearer' => config('services.steam.token')]
        );
        $pubg_news = json_decode($pubg_response->getBody(), true);
        
        $latest_comment = Comments::where('user_id', '=', $comment->user_id);
        return view('posts/search')->with([
            'comments' => $comments,
            'replies' => $replies,
            'apex_newses' => $apex_news['appnews']['newsitems'],
            'pubg_newses' => $pubg_news['appnews']['newsitems']
        ]);
    }
    
    //画像アイコン登録
    public function image_store(Request $request)
    {
        $path = $request->image->store('public/profiles');
        $filename = basename($path);
        $data = new FileImage;
        $data->file_name = $filename;
        $data->save();
    }
    
}
?>