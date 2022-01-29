<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::where('status',Product::Dang_Ban)
                            ->orWhere('status',Product::Het_Hang)
                            ->get(); //Lấy ra các sản phẩm đang bán và hết hàng;

        if(isset($request->key))
        {
            $product = Product::where('name','LIKE','%'. $request->key .'%')
                                // ->where('status',Product::Dang_Ban)
                                // ->orWhere('status',Product::Het_Hang)
                                ->get();
        }
        

        $products_random = Product::where('status',Product::Dang_Ban)
                                    ->inRandomOrder()
                                    ->limit(6)
                                    ->get();
        // foreach($products_random as $v)
        // {
        //     echo $v->name;
        // }

        // dd("SGOP");
        return view('client.home',[
            'products' => $product,
            'products_random' => $products_random,
        ]);
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
    public function show($id)
    {
        //
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
        //
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

    //Form đăng nhập bên phía người dùng
    public function formLoginClient()
    {
        return view('client.login.login');
    }

    //Form đăng kí cho người dùng

    public function formRegisterClient()
    {
        return view('client.login.register');
    }
}
