<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comments;

use App\Apex;
use App\Valorant;
use App\Pubg;

use Illuminate\Http\Request;

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
}
