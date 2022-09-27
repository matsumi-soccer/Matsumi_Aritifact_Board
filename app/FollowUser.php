<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class FollowUser extends Model
{
    protected $fillable = ['following_user_id', 'followed_user_id'];
    
    protected $table = 'follow_users';
    
    public function getCountAmount()
    {
      return DB::table('follow_users')
              ->select('followed_user_id')
              ->selectRaw('COUNT(followed_user_id) as count_userid')
              ->groupBy('followed_user_id')
              ->orderBy('count_userid', 'desc')
              ->take(3)
              ->get();
    }
    
    public function getAllCountAmount()
    {
      return DB::table('follow_users')
              ->select('followed_user_id')
              ->selectRaw('COUNT(followed_user_id) as count_userid')
              ->groupBy('followed_user_id')
              ->orderBy('count_userid', 'desc')
              ->take(20)
              ->get();
    }
}


