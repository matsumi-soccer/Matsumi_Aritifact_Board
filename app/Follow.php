<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'following_id',
        'followed_id',
    ];
}
