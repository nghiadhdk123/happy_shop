<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use Carbon\Carbon;
use App\Models\User;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('created_at','DESC')->get();
        return view('admin.voucher.index',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        $voucher = new Voucher();

        $voucher->name = $request->get('name');
        $voucher->code = $request->get('code');
        $voucher->percent = $request->get('percent');
        $voucher->expiry = $request->get('expiry');
        $time_now = Carbon::now()->toDateString();
        // dd($voucher);

        if($voucher->expiry < $time_now)
        {
            $request->session()->flash('error_time','Hạn sử dụng voucher phải lớn hơn ngày hiện tại');
            return back();
        }else{
            $voucher->save();
            return back()->with('success','Tạo mới voucher thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function share($code)
    {
        $users = User::where('role',User::USER)->get();
        $voucher = Voucher::where('code',$code)->first();
        $time_now = Carbon::now()->toDateString();
        if($voucher->expiry < $time_now)
        {
            return back()->with('error','Voucher đã hết hạn sử dụng');
        }
        return view('admin.voucher.share-voucher',[
            'users' => $users,
            'voucher' => $voucher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shareSuccess(Request $request,$code)
    {
        $voucher = Voucher::where('code',$code)->first();
        $time_now = Carbon::now()->toDateString();

        if($voucher->expiry < $time_now)
        {
            return back()->with('error','Voucher đã hết hạn sử dụng');
        }else{
            if($request->user != null)
            {
                foreach($request->user as $value)
                {
                    $voucher->shareUsers()->attach($value);
                }
             }
        }
        return redirect()->route('voucher.index')->with('success','Phát voucher thành công');
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
