<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfor;
use App\Models\Order;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Profile của người dùng
    public function profileClient($id)
    {
        if(!Auth::user())
        {
            return view('client.login.login');
        }else{
            if($id != Auth::user()->id)
            {
                dd("Đừng có mà hack thông tin của người khác bạn ơi!!");
            }else{
                $user = User::find($id);
                return view('client.user.profile',compact('user'));
            }
        }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id != Auth::user()->id)
        {
            dd("Đừng có mà hack thông tin của người khác bạn ơi!!");
        }else{
            $user = User::find($id);        

            $user->name = $request->get('name');
            $user->phone = $request->get('phone');
            $user->address = $request->get('address');
            $user->gender = $request->get('gender');

            $user->save();

            $userInfo = UserInfor::where('user_id',$id)->first();
            $userInfo->nickname = $request->get('nickname');
            $userInfo->lover = $request->get('lover');
            $userInfo->date = $request->get('date');

            $userInfo->save();

            return back()->with('success','Thay đổi thành công');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myOrder($id)
    {
        if(!Auth::user())
        {
            return view('client.login.login');
        }
        $orders = Order::where('user_id',$id)
                        ->whereNotIn('status',[Order::ORDER_CONFIRM_CANCEL,Order::ORDER_FINISH])
                        ->orderBy('id','DESC')
                        ->get();

        return view('client.cart.flow-oder',compact('orders'));
    }
}
