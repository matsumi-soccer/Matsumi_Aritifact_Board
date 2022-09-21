<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Follow extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'following_id',
        'followed_id',
    ];
    
    public function getCountAmount()
    {
      return DB::table('follows')
              ->select('followed_id')
              ->selectRaw('COUNT(followed_id) as count_userid')
              ->groupBy('followed_id')
              ->take(3)
              ->get();
    }
    
    public function getAllCountAmount()
    {
      return DB::table('follows')
              ->select('followed_id')
              ->selectRaw('COUNT(followed_id) as count_userid')
              ->groupBy('followed_id')
              ->take(20)
              ->get();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
