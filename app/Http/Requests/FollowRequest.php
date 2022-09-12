<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
{
    public function rules()
    {
        return [
            'follows.following_id' => 'required',
            'follows.followed_id' => 'required',
        ];
    }
}
