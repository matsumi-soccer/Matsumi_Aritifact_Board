<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'sex', 'apex_rank', 'valorant_rank', 'pubg_rank', 'profile_image', 'twitter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
    
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    // public function follows()
    // {
    //     return $this->hasMany('App\Follow');
    // }
    
    public function apex()
    {
        return $this->belongsTo('App\Apex');    
    }
    
    public function valorant()
    {
        return $this->belongsTo('App\Valorant');
    }
    
    public function pubg()
    {
        return $this->belongsTo('App\Pubg');
    }
    
    //いいね機能
    public function favorites()
    {
        return $this->belongsToMany('App\Comments')->withTimestamps();
    }
    
    // フォロワー→フォロー
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }

    // フォロー→フォロワー
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
}
