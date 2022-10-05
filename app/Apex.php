<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apex extends Model
{
    public $timestamps = false;
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
