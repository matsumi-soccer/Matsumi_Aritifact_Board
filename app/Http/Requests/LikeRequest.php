<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{

    public function rules()
    {
        return [
            'likes.user_id' => 'required',
            'likes.comment_id' => 'required',
        ];
    }
}
