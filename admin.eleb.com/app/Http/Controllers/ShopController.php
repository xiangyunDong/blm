<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;

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
            'shop_img'=>'image | required',
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
        $img=$request->file('shop_img');
        $path=$img->store('public/shop');
        Shop::create([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
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
        $img=$request->file('shop_img');
        if($img){
            $path=$img->store('public/shop');
        }else{
            $path = $shop->shop_img;
        }
        $shop->update([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
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
}
