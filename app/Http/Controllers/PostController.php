<?php

namespace App\Http\Controllers;

/*use Illuminate\Http\Request;*/
use App\Post;
use App\Http\Requests\PostRequest;
use App\Comments;
use App\Apex;
use App\Valorant;
use App\Pubg;

class PostController extends Controller
{
    //ホーム画面
    public function index(Comments $comment, Apex $apex, Valorant $valorant, Pubg $pubg)
    {
        return view('posts/index')->with(['comments'=>$comment->getPaginateByLimit(), 'apex'=>$apex->get(), 'valorant'=>$valorant->get(), 'pubg'=>$pubg->get()]);
    }
    
    public function apex_chat(Apex $apex, Comments $comment)
    {
        return view('posts/apex_chat')->with(['apex' => $apex, 'comments' => $comment->get()]);
    }
    
    public function valorant_chat(Valorant $valorant, Comments $comment)
    {
        return view('posts/valorant_chat')->with(['valorant' => $valorant, 'comments' => $comment->get()]);
    }
    
     public function pubg_chat(Pubg $pubg, Comments $comment)
    {
        return view('posts/pubg_chat')->with(['pubg' => $pubg, 'comments' => $comment->get()]);
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