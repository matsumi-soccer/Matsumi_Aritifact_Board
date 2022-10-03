<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Auth;

class AddImageController extends Controller
{
    public function addImage(Request $request)
    {
        //$img = $request->image->store('public');
        $file_name = $request->image->getClientOriginalName();
        $img = $request->image->storeAs('public/profiles', $file_name);
        DB::table('users')
            ->where('id', \Auth::user()->id)
            ->update(['profile_image' => $file_name]);

        
        $file_path = \DB::table('users')->where('id',\Auth::user()->id)->first();
        return redirect()->back();
    }

}
