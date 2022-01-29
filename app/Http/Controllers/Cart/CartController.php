<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Voucher;
use Auth;
use Session;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::content();
        return view('client.cart.cart',compact('items'));
    }

    public function add(Request $request)
    {

        $data = $request->all();
        // print_r($data);
        $product = Product::find($data['id_product']);

        $ca = Cart::add($product->id,$product->name,1,$product->sale_price,0,[
            'image' => $product->images[0]->image_url,
            'quantity'  => $product->inventory,
        ]);

    }

    public function delete(Request $request)
    {
           $id = $request->get('id');
           $cart = Cart::remove($id);

           if(Cart::count() == 0)
           {
               Session::forget('code_voucher');
           }
    }

    public function update(Request $request)
    {
        $cart = Cart::get($request->rowId);
        Cart::update($request->rowId,$request->qty);
    }

    public function pay(Request $request)
    {

        if(!Auth::user())
        {
            return redirect()->route('login-client');
        }

       $order = new Order();

       $order->code = Str::random(6);
       $order->name = $request->get('name');
       $order->phone = $request->get('phone');
       $order->address = $request->get('address');
       $order->note = $request->get('note');
       $order->total_price = Cart::total();
       $order->pay_method = $request->get('pay_method');
       if($order->pay_method == 2)
       {
           $order->total_price = $order->total_price - $order->total_price*5/100;
       }
       if(Session::get('code_voucher'))
       {
           foreach(Session::get('code_voucher') as $key => $vou)
           {
                $order->total_price = $order->total_price - $order->total_price*$vou['percent']/100;
                $voucher = Auth::user()->haveVouchers()->where('code',$vou['code'])->first();
                $voucher->pivot->status = 0;
                $voucher->pivot->save();
           }
       }
     
       $order->status = 0;
       $order->user_id = Auth::user()->id;
       $order->created_at = Carbon::now();

       $order->save();

       $items = Cart::content();
       foreach($items as $item)
       {
           $order->products()->attach($item->id,[
                'name' => $item->name,
                'quantity' => $item->qty,
                'price' => $item->price,
                'created_at' => Carbon::now(),
           ]);
       }

       Session::forget('code_voucher');
       Cart::destroy();

       alert()->success('Đặt hàng thành công','Cảm ơn bạn đã mua hàng tại E-SHOPPER');
       return redirect()->route('home');
    }

    public function checkVoucher(Request $request)
    {
        $user = Auth::user();
        $voucher = $user->haveVouchers()->where('code',$request->get('code'))->first();
        if($voucher)
        {
            if($voucher->pivot->status == 0){
                return back()->with('error','Mã giảm giá này đã được sử dụng');
            }else{
                $time_now = Carbon::now()->toDateString();
                if($time_now > $voucher->expiry)
                {
                    Session::forget('code_voucher');
                    return back()->with('error','Mã giảm giá này đã hết hạn sử dụng');
                }else{
                    $code_session = Session::get('code_voucher');
                    if($code_session == true)
                    {
                        // dd('Có sesssion');
                        $vou[] = array(
                            'code' => $voucher->code,
                            'percent' => $voucher->percent,
                        );
                        Session::put('code_voucher',$vou);
                    }else{
                        // dd('Ko có session');
                        $vou[] = array(
                            'code' => $voucher->code,
                            'percent' => $voucher->percent,
                        );
                        Session::put('code_voucher',$vou);
                    }
                    Session::save();
                    //  Session::forget('code_voucher');
                    return back()->with('success','Nhập mã giảm giá thành công');
                }
            }
        }else{
            Session::forget('code_voucher');
            return back()->with('error','Mã giảm giá này không tồn tại');
        }
    }
}
