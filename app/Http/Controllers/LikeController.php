<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class LikeController extends Controller
{
    public function store(Comments $comment)
   {
       $user = Auth::user();
       if($user->id != $comment->user_id) {
           if($comment->isLiked(Auth::id())) {
               // 対象のレコードを取得して、削除する。
               $delete_record = $comment->getLike($user->id);
               $delete_record->delete();
           } else {
               $like = Like::firstOrCreate(
                   array(
                       'user_id' => Auth::user()->id,
                       'comment_id' => $comment->id
                   )
               );
           }
       }
   }
}
