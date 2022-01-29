<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Statis;
use App\Models\Product;
use PDF;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at','DESC')->get();
        return view('admin.order.index',compact('orders'));
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
        $order = Order::find($id);
        return view('admin.order.detail',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit()
    // {
    //     $order = Order::find(4);
    //     // $product = Product::find(11);
    //     foreach($order->products as $value)
    //     {
    //         echo $value->pivot->order_id;
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $id = $request->get('id');
        $data = $request->all();
        $order = Order::find($data['id']);
        $order->status = $data['status'];
        $order->save();

        $now  = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $profit = 0;
        $quantity = 0;

        if($order->status == Order::ORDER_CONFIRM || $order->status == Order::ORDER_SHIPPING || $order->status == Order::ORDER_FINISH)
        {
            foreach($order->products as $value)
            {
                $value->inventory = $value->inventory - $value->pivot->quantity;
                $value->sell_number += $value->pivot->quantity;
                $value->save();
            }
        }


        if($order->status == Order::ORDER_FINISH)
        {
            $statis = Statis::where('order_date',$now)->first();
            if($statis)
            {   
                    foreach($order->products as $value)
                    {
                        $quantity += $value->pivot->quantity;
                        $profit += $order->total_price - ($value->pivot->quantity * $value->origin_price);
                    }

                    $statis->sales += $order->total_price;
                    $statis->quantity += $quantity;
                    $statis->profit += $profit;
                    $statis->total_order += 1;
                    $statis->updated_at = Carbon::now();
                    $statis->save();
            }else{

                foreach($order->products as $value)
                    {
                        $quantity += $value->pivot->quantity;
                        $profit += $order->total_price - ($value->pivot->quantity * $value->origin_price);
                    }
                    $statis = new Statis;
                    $statis->order_date = $now;
                    $statis->sales += $order->total_price;
                    $statis->quantity += $quantity;
                    $statis->profit += $profit;
                    $statis->total_order += 1;
                    $statis->updated_at = Carbon::now();
                    $statis->save();
            }
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

    public function cancel(Request $request)
    {
        $data = $request->all();

        $order = Order::where('code',$data['id'])->first();
        $order->reason = $data['reason'];
        $order->status = 4;

        $order->save();
    }

    public function Check(Request $request)
    {
        $data = $request->all();

        $order = Order::where('code',$data['id'])->first();
        $order->status = Order::ORDER_CONFIRM_CANCEL;
        $order->save();

    }

    public function Times(Request $request)
    {
        $data = $request->all();

        $order = Order::where('code',$data['id'])->first();
        $order->status = Order::ORDER_CONFIRM;
        $order->save();
    }
}
