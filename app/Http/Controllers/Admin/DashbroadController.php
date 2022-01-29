<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Statis;
use App\Models\Tag;
use Carbon\Carbon;

class DashbroadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role',User::USER)->get();
        $staff = User::where('role',User::STAFF)->get();
        $categories = Category::all();
        $products = Product::all();
        $orders = Order::all();
        $statis = Statis::all();
        $tag = Tag::all();
        $profit = 0;
        foreach($statis as $value)
        {
            $profit+= $value->profit;
        }
        $new_product = Product::orderBy('id','DESC')
                                ->limit(5)
                                ->get();
        
        $On_sale = Product::where('status',Product::Dang_Ban)->get();
        $Out_of_stock = Product::where('status',Product::Het_Hang)->get();
        $Stop_sale = Product::where('status',Product::Dung_Ban)->get();
        

        return view('admin.dashbroad.dashbroad',[
            'users' => $users,
            'staff' => $staff,
            'categories' => $categories,
            'products' => $products,
            'orders' => $orders,
            'profit' => $profit,
            'new' => $new_product,
            'tag' => $tag,
            'on_sale' => $On_sale,
            'out_of_stock' => $Out_of_stock,
            'stop_sale' => $Stop_sale,
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
}
