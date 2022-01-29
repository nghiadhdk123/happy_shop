<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserInfor;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');        
    }

    public function login(Request $request)
    {
            $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($data)){
            if(Auth::User()->is_active == 0)
            {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('warning','Tài khoản này hiện đang bị khóa.');
            }else{
                $request->session()->regenerate();
                Auth::User()->active = 1;
                Auth::User()->save();
                return redirect()->intended('/admin');
            }
            
        } else{
            $request->session()->flash('status', 'Thông tin không chính xác !');
            return back();
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->password = Hash::make($request->get('password'));

        $user->save();

        if($user)
        {
            $userInfo = new UserInfor();
            $userInfo->user_id = $user->id;
            $userInfo->save();
        }

        Auth::login($user);
         return redirect()->intended('/');
    }
}
