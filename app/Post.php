<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
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
