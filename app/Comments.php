<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comments extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'game_id',
        'body',
    ];
    
    public function getByLimit(int $limit_count = 20)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    //ページネーション
    public function getPaginateByLimit(int $limit_count=20)
    {
        //return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
    public function isLiked($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }
}
