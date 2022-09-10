<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'comment_id',
        'body',
    ];
    
    public function getPaginateByLimit(int $limit_count=20)
    {
        //return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function comment()
    {
        return $this->belongsTo('App\User');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
