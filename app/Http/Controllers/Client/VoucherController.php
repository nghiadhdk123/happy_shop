<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\User;
use Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($id != Auth::user()->id)
        {
            dd("Đừng có mà hack thông tin của người khác bạn ơi!!");
        }else{
            $user = User::find($id);
            return view('client.my-voucher.index',compact('user'));
        }
    }
}
