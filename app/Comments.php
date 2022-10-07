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
        'profile_image',
    ];
    
    public function getPagenate(int $limit_count=5)
    {
         return $this->orderBy('created_at', 'DESC')->paginate($limit_count);
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
