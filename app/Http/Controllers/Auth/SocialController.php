<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfor;
use Validator;
use Socialite;
use Exception;
use Auth;

class SocialController extends Controller
{

    //Login Facebook
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
            
            if($isUser){
                Auth::login($isUser);
                Auth::User()->active = 1;
                Auth::User()->save();
                return redirect()->route('dash.admin');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'avatar_url' => $user->avatar,
                    'auth_type'=> 'facebook',
                    'password' => bcrypt('facebook'),
                    'active' => '1',
                ]);

                if($createUser)
                {
                    $user_id = User::all()->last();
                    UserInfor::create([
                        'user_id' => $user_id->id,
                    ]);

                }
    
                Auth::login($createUser);
                return redirect()->route('dash.admin');
            }
    
        } catch (Exception $exception) {
            // return redirect()->route('dash.admin');
            dd("Hello");
        }
    }

    //Login Google

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('gg_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
                Auth::User()->active = 1;
                Auth::User()->save();
                return redirect()->route('dash.admin');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gg_id'=> $user->id,
                    'avatar_url' => $user->avatar,
                    'auth_type'=> 'google',
                    'password' => bcrypt('google'),
                    'active' => '1'
                ]);

                if($newUser)
                {
                    $user_id = User::all()->last();
                    UserInfor::create([
                        'user_id' => $user_id->id,
                    ]);

                }
      
                Auth::login($newUser);
      
                 return redirect()->route('dash.admin');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    //Login GitHub

    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        try {
     
            $user = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $user->id)->first();
      
            if($searchUser){
      
                Auth::login($searchUser);
                Auth::User()->active = 1;
                Auth::User()->save();
                return redirect()->route('dash.admin');
      
            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'avatar_url' => $user->avatar,
                    'auth_type'=> 'github',
                    'password' => bcrypt('github'),
                    'active' => '1'
                ]);

                if($gitUser)
                {
                    $user_id = User::all()->last();
                    UserInfor::create([
                        'user_id' => $user_id->id,
                    ]);

                }
     
                Auth::login($gitUser);
      
                return redirect()->route('dash.admin');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
