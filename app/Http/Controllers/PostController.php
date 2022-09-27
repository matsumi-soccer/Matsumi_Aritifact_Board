<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class PostController extends Controller
{
    //ホーム画面
    public function index(Comments $comment, Apex $apex, Valorant $valorant, Pubg $pubg, Follow $follows)
    {
        return view('posts/index')->with(['comments'=>$comment->getPaginateByLimit(), 'apex'=>$apex->select('id', 'rank')->get(), 'valorant'=>$valorant->select('id', 'rank')->get(), 'pubg'=>$pubg->select('id', 'rank')->get(), 'follows'=>$follows->getCountAmount()]);
    }
    
    public function apex_chat(Apex $apex, Comments $comment, Reply $reply, Like $like)
    {
        return view('posts/apex_chat')->with(['apex' => $apex, 'comments' => $comment->get(), 'replies' => $reply->get(), 'likes' => $like->get()]);
    }
    
    public function valorant_chat(Valorant $valorant, Comments $comment, Reply $reply, Like $like)
    {
        return view('posts/valorant_chat')->with(['valorant' => $valorant, 'comments' => $comment->get(), 'replies' => $reply->get(), 'likes' => $like->get()]);
    }
    
    public function pubg_chat(Pubg $pubg, Comments $comment,  Reply $reply, Like $like)
    {
        return view('posts/pubg_chat')->with(['pubg' => $pubg, 'comments' => $comment->get(), 'replies' => $reply->get(), 'likes' => $like->get()]);
    }
    
    //コメント作成
    public function create()
    {
        return view('posts/create');
    }
    
    //コメント保存
    public function store(PostRequest $request, Comments $comment)
    {
        $input = $request['comments'];
        $comment->fill($input)->save();
        return redirect()->back();
    }
    
    //コメント編集
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
    public function store_reply(ReplyRequest $request, Reply $reply)
    {
        $input = $request['replies'];
        $reply->fill($input)->save();
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
        return view('posts/mypage')->with(['comments' => $comment->get(), 'replies' => $reply->get(),'apexes' => $apex->get(), 'valorants'=> $valorant->get(), 'pubgs'=>$pubg->get()]);
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
        return view('posts/user_page')->with([
            'comment' => $comment, 
            'follows' => $follow->get(), 
            'apexes' => $apex->get(), 
            'valorants'=> $valorant->get(), 
            'pubgs'=>$pubg->get(),
        ]);
    }

    //followerランキング画面
    public function follower_lanking(Comments $comment, Follow $follow)
    {
         return view('posts/follower_lanking')->with(['comments' => $comment->get(), 'follows' => $follow->getAllCountAmount()]);
    }
    
    //キーワード検索画面
    public function search(Request $request)
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
        
        return view('posts/search')->with(['comments' => $comments, 'replies' => $replies]);
    }
    
}
?>