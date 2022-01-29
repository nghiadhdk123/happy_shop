<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LogoutController extends Controller
{
    public function logout(Request $request){

        Auth::User()->time_login = Carbon::now('Asia/Ho_Chi_Minh');
        Auth::User()->active = 0;
        Auth::User()->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
