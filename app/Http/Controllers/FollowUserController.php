<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FollowUser;
use App\Auth;

class FollowUserController extends Controller
{
    //フォロー
    public function follow($userId) {
        $follow = FollowUser::create([
            'following_user_id' => \Auth::user()->id,
            'followed_user_id' => $userId,
        ]);
        $followCount = count(FollowUser::where('followed_user_id', $userId)->get());
        return response()->json(['followCount' => $followCount]);
    }

    //フォロー解除
    public function unfollow($userId) {
        $follow = FollowUser::where('following_user_id', \Auth::user()->id)->where('followed_user_id', $userId)->first();
        $follow->delete();
        $followCount = count(FollowUser::where('followed_user_id', $userId)->get());

        return response()->json(['followCount' => $followCount]);
    }
}
