<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){

        $shops=Shop::paginate(3);
        return view('shop.index',compact('shops'));
    }

    public function create(){
        $shop_categories=ShopCategory::all();
        return view('shop.create',compact('shop_categories'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_rating'=>'required',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required|integer',
            'send_cost'=>'required|integer',
            'notice'=>'required',
            'discount'=>'required',
            'status'=>'required',
        ]);
        //图片处理
        Shop::create([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$request->shop_img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ]);
        $request->session()->flash('success','商家添加成功');
        return redirect()->route('shops.index');
    }

    public function edit(Shop$shop){
        $shop_categories=ShopCategory::all();
        return view('shop.edit',compact('shop','shop_categories'));
    }
    public function update(Request$request,Shop$shop){
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_rating'=>'required',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required|integer',
            'send_cost'=>'required|integer',
            'notice'=>'required',
            'discount'=>'required',
            'status'=>'required',
        ]);
        $shop->update([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$request->shop_img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ]);
        $request->session()->flash('success','商家修改成功');
        return redirect()->route('shops.index');
    }

    public function destroy(Shop$shop){
        $shop->delete();
        session()->flash('success','商家删除成功');
        return redirect()->route('shops.index');
    }
    public function audit(Shop$shop){
        $shop->status=1;
        $shop->save();
        session()->flash('success','商家审核成功');
        $title = '邮件体验';
        $content = '<p>	
            重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
            随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
        try{
            Mail::send('email.default',compact('title','content'),
                function($message){
                    $to = 'm13551100357@163.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('邮件体验');
                });
        }catch (Exception $e){
            return '邮件发送失败';
        }
        return redirect()->route('shops.index');
    }
}
