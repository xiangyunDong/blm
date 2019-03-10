<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $orders=Order::where('shop_id',Auth::user()->shop_id)->paginate(3);

        return view('order.index',compact('orders'));
    }

    public function show(Order$order){
        $order=Order::where('id',$order->id)->first();
        $details=OrderDetail::where('order_id',$order->id)->get();
        //dd($details);
        return view('order.show',compact('details'));
    }

    public function cancel(Order$order){
        $order->status=-1;
        $order->save();
        session()->flash('success','取消订单成功');
        return redirect()->route('orders.index');
    }

    public function send(Order$order){
        $order->status=2;
        $order->save();
        session()->flash('success','订单发货成功');
        return redirect()->route('orders.index');
    }
    public function count(Request$request){
        //dd(date('d'));
        $keyword=$request->keyword;
        if($keyword==1){
            $title="近一周订单量";
            for($i=6;$i>=0;$i--):
            $datas[date('Y-m-d',strtotime("-$i day"))]=Order::whereDay('created_at',date("d")-$i)->count();
            endfor;
            return view('order.count',compact('title','datas'));
        }elseif($keyword==2){
            $title="近三月订单量";
            for($i=2;$i>=0;$i--):
                $datas[date('Ym')-$i]=Order::whereMonth('created_at',date('m')-$i)->count();
            endfor;
            //dd($datas);
            return view('order.count',compact('title','datas'));
        }elseif ($keyword==-1){
            $title="总计订单量";
            for($i=1;$i>=0;$i--):
                $datas[date('Y')-$i]=Order::whereYear('created_at',date('Y')-$i)->count();
            endfor;
            //dd($datas);
            return view('order.count',compact('title','datas'));
        }

    }
}
