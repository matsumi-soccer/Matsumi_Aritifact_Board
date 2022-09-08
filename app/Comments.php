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
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
