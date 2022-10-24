<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user.email'=>'required',
            'user.age'=>'required',
            'user.sex'=>'required',
            'user.apex_rank'=>'required',
            'user.valorant_rank'=>'required',
            'user.pubg_rank'=>'required',
        ];
    }
}
