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
    public function index(Comments $comment, Apex $apex, Valorant $valorant, Pubg $pubg)
    {
        return view('posts/index')->with(['comments'=>$comment->getPaginateByLimit(), 'apex'=>$apex->get(), 'valorant'=>$valorant->get(), 'pubg'=>$pubg->get()]);
    }
    
    public function apex_chat(Apex $apex)
    {
        return view('posts/apex_chat')->with(['apex' => $apex]);
    }
    
    public function valorant_chat(Valorant $valorant)
    {
        return view('posts/valorant_chat')->with(['valorant' => $valorant]);
    }
    
     public function pubg_chat(Pubg $pubg)
    {
        return view('posts/pubg_chat')->with(['pubg' => $pubg]);
    }
    
    public function create()
    {
        return view('posts/create');
    }
    
    public function store(PostRequest $request, Comments $comment)
    {
        $input = $request['comments'];
        $comment->fill($input)->save();
        return redirect('/');
    }
    
    public function mypage(Comments $comment)
    {
        return view('posts/mypage')->with(['comments' => $comment->get()]);
    }
    
    public function edit(Comments $comment)
    {
        return view('posts/edit')->with(['comment' => $comment]);
    }
    
    public function update(PostRequest $request, Comments $comment)
    {
        $input_post = $request['comments'];
        $comment->fill($input_post)->save();
    
        return redirect('/posts/mypage');
    }
}
?>