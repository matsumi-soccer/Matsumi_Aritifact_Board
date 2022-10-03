<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'replies.user_id' => 'required',
            'replies.game_id' => 'required',
            'replies.comment_id' => 'required',
            'replies.body' => 'required|string|max:300',
            'replies.reply_image' => 'max:2048',
        ];
    }
}
