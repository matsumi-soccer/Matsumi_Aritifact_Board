<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Auth;

class AddImageController extends Controller
{
    // public function addImage(Request $request)
    // {
    //     //Userのプロフィール画像変更
    //     $file_name = $request->image->getClientOriginalName();
    //     $img = $request->image->storeAs('public/profiles', $file_name);
    //     DB::table('users')
    //         ->where('id', \Auth::user()->id)
    //         ->update(['profile_image' => $file_name]);

    //     $file_path = \DB::table('users')->where('id',\Auth::user()->id)->first();
    //     return redirect()->back();
    // }
    public function addImage(Request $request)
    {
        //Userのプロフィール画像変更
        if( app()->isLocal()|| app()->runningUnitTests())
        {
            $file_name = $request->image->getClientOriginalName();
            $img = $request->image->storeAs('public/profiles', $file_name);  
            
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['profile_image' => $file_name]);
        }else{
            # 本番環境
            $image = $request->image->getClientOriginalName();
            $path = Storage::disk('s3')->put('/public', $image, 'public');
            //$request->image = Storage::disk('s3')->url($path);
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['profile_image' => $image]);
        }
        
      

        $file_path = \DB::table('users')->where('id',\Auth::user()->id)->first();
        return redirect()->back();
    }

}
