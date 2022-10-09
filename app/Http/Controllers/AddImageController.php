<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Auth;

class AddImageController extends Controller
{
    public function addImage(Request $request)
    {
        //開発環境
        if( app()->isLocal()|| app()->runningUnitTests())
        {
            $file_name = $request->image->getClientOriginalName();
            $img = $request->image->storeAs('public/profiles', $file_name);
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['profile_image' => $file_name]);
    
            $file_path = \DB::table('users')->where('id',\Auth::user()->id)->first();
            return redirect()->back();
        }else{
            //本番環境
            $file_name = $request->image;
            Storage::disk('s3')->delete($file_name);
            $path = Storage::disk('s3')->putFile('/', $file_name, 'public');
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['profile_image' => $path]);
            return redirect()->back();
            
        }

    }
}
