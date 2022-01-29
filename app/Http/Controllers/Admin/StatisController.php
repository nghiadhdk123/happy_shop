<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statis;
use Carbon\Carbon;

class StatisController extends Controller
{
    public function index()
    {
        return view('admin.statictical.index');
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();

        $from_date = $data['from_date'];

        $to_date = $data['to_date'];

        $get = Statis::whereBetween('order_date',[$from_date,$to_date])
                        ->orderBy('order_date','ASC')
                        ->get();
        // $chart_data[] = array();
        foreach($get as $key => $value)
        {
             $chart_data[] = array(

                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity

            );
        }
        echo $data = json_encode($chart_data);
        // for($i=0 ; $i < 5 ; $i++)
        // {
        //     $sum[] = array(
        //         'name' => "Trần Đình Nghĩa",
        //     );
        // }
        // echo $data = json_encode($sum);
    }

    public function OneMonth()
    {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now =  Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statis::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $value) {
            $chart_data[] = array(

                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filterday(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc =Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc =Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now =  Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Statis::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangtruoc')
        {
            $get = Statis::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangnay')
        {
            $get = Statis::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }
        else
        {
            $get = Statis::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filteryear(Request $request)
    {
        $data = $request->all();

        $year = $data['year'];

        $get = Statis::whereYear('order_date',$year)->orderBy('order_date','ASC')->get();

        foreach($get as $key => $value)
        {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );  
        }
        echo $data = json_encode($chart_data);
    }

    public function TwoWeeks()
    {
        $sub14days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(14)->toDateString();  //Lấy thời gian hiện tại giảm đi 14 ngày trước
        // $now =  Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $now = Carbon::now()->year;  // Lấy năm hiện tại
        // $get = Statis::whereBetween('order_date',[$sub14days,$now])->orderBy('order_date','ASC')->get();
        $get = Statis::whereYear('order_date',$now)->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $value) {
            $chart_data[] = array(
                
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
