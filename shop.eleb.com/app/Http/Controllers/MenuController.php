<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuCategory;
use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $menus=Menu::paginate(3);
        return view('menu.index',compact('menus'));
    }

    public function create(){
        $menu_categories=MenuCategory::all();
        $shops=Shop::all();
        return view('menu.create',compact('shops','menu_categories'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'goods_name'=>'required',
            'rating'=>'required|integer',
            'shop_id'=>'required',
            'category_id'=>'required',
            'goods_price'=>'required|integer',
            'description'=>'required',
            'month_sales'=>'required|integer',
            'rating_count'=>'required|integer',
            'tips'=>'required',
            'satisfy_count'=>'required|integer',
            'satisfy_rate'=>'required|integer',
            'goods_img'=>'image | required',
            'status'=>'required',
        ]);
        //图片处理
        $img=$request->file('goods_img');
        $path=$img->store('public/menu');
        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'goods_img'=>url(Storage::url($path)),
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'status'=>$request->status,
        ]);
        $request->session()->flash('success','菜品添加成功');
        return redirect()->route('menus.index');
    }

    public function edit(Menu$menu){
        $menu_categories=MenuCategory::all();
        $shops=Shop::all();
        return view('menu.edit',compact('menu','shops','menu_categories'));
    }
    public function update(Request$request,Shop$shop){
        $this->validate($request,[
            'goods_name'=>'required',
            'rating'=>'required|integer',
            'shop_id'=>'required',
            'category_id'=>'required',
            'goods_price'=>'required|integer',
            'description'=>'required',
            'month_sales'=>'required|integer',
            'rating_count'=>'required|integer',
            'tips'=>'required',
            'satisfy_count'=>'required|integer',
            'satisfy_rate'=>'required|integer',
            'status'=>'required',
        ]);
        $img=$request->file('goods_img');
        if($img){
            $path=$img->store('public/menu');
        }else{
            $path = $shop->goods_img;
        }
        $shop->update([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'goods_img'=>url(Storage::url($path)),
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'status'=>$request->status,
        ]);
        $request->session()->flash('success','菜品修改成功');
        return redirect()->route('menus.index');
    }

    public function destroy(Menu$menu){
        $menu->delete();
        session()->flash('success','菜品删除成功');
        return redirect()->route('menus.index');
    }
    public function audit(Shop$shop){
        $shop->status=1;
        $shop->save();
        session()->flash('success','商家审核成功');
        return redirect()->route('shops.index');
    }
}
