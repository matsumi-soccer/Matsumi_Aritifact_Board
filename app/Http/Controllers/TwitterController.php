<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class TwitterController extends Controller
{
    // Twitterログイン
    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }
 
    public function handleProviderCallback() {
        try {
            $twitterUser=Socialite::with('twitter')->user();
        }catch (Exception $e) {
            return redirect('login/twitter');
        }
 
        $user=User::where('twitter', $twitterUser->id)->first();
 
        if($user) {
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->update();
        }else {
            $user=New User();
            $user->twitter = $twitterUser->id;
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->apex_rank = 100;
            $user->valorant_rank = 100;
            $user->pubg_rank = 100;
            $user->save();
        }
 
        Auth::login($user);
        return redirect('/');
    }
}
