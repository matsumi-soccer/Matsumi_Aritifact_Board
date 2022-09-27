<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;
use Auth;

class FavoriteController extends Controller
{

    
    public function store($id)
    {
        $comment = Comments::find($id);
        $comment->users()->attach(Auth::id());
        $count = $comment->users()->count();
        $result = true;
        return response()->json([
            'result' => $result,
            'count' => $count,
        ]);
    }
    
    public function destroy($id)
    {
        $comment = Comments::find($id);
        $comment->users()->detach(Auth::id());
        $count = $comment->users()->count();
        $result = false;
        return response()->json([
            'result' => $result,
            'count' => $count,
        ]);
    }
    
    public function hasfavorite($id)
    {
        $comment = Comments::find($id);
        if($comment->users()->where('user_id', Auth::id())->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        
        return response()->json($result);
    }
    
    public function count($id)
    {
        $comment = Comments::find($id);
        $count = $comment->users()->count();
        
        return response()->json($count);
    }
}
