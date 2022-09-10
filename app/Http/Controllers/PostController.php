<?php

namespace App\Http\Controllers;

/*use Illuminate\Http\Request;*/
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ReplyRequest;
use App\Comments;
use App\Reply;
use App\Apex;
use App\Valorant;
use App\Pubg;
use App\User;

class PostController extends Controller
{
    //ホーム画面
    public function index(Comments $comment, Apex $apex, Valorant $valorant, Pubg $pubg)
    {
        return view('posts/index')->with(['comments'=>$comment->getPaginateByLimit(), 'apex'=>$apex->get(), 'valorant'=>$valorant->get(), 'pubg'=>$pubg->get()]);
    }
    
    public function apex_chat(Apex $apex, Comments $comment, Reply $reply)
    {
        return view('posts/apex_chat')->with(['apex' => $apex, 'comments' => $comment->get(), 'replies' => $reply->get()]);
    }
    
    public function valorant_chat(Valorant $valorant, Comments $comment, Reply $reply,)
    {
        return view('posts/valorant_chat')->with(['valorant' => $valorant, 'comments' => $comment->get(), 'replies' => $reply->get()]);
    }
    
     public function pubg_chat(Pubg $pubg, Comments $comment,  Reply $reply,)
    {
        return view('posts/pubg_chat')->with(['pubg' => $pubg, 'comments' => $comment->get(), 'replies' => $reply->get()]);
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
        return redirect('/');
    }
    
    //リプライ保存
    public function store_reply(ReplyRequest $request, Reply $reply)
    {
        $input = $request['replies'];
        $reply->fill($input)->save();
        return redirect()->back();
    }
    
    //マイページ
    public function mypage(Comments $comment)
    {
        return view('posts/mypage')->with(['comments' => $comment->get()]);
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
}
?>