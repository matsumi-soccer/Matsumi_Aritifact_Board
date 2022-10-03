<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'comments.user_id' => 'required',
            'comments.game_id' => 'required',
            'comments.body' => 'required|string|max:300',
            'comments.profile_image' => 'max:2048',
        ];
    }
}
