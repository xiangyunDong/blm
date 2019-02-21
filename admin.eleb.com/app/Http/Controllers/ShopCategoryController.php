<?php

namespace App\Http\Controllers;

use App\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    public function index(){
       //$shop_categories=ShopCategory::all();
        $shop_categories=ShopCategory::paginate(3);
       return view('shopcategory.index',compact('shop_categories'));
    }

    public function create(){
        return view('shopcategory.create');
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'img'=>'image | required',
            'status'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'img.image'=>'图片规格错误',
            'img.required'=>'图片不能为空',
            'status'=>'请选择状态'
        ]);
        //图片处理
        $img=$request->file('img');
        $path=$img->store('public/shop_category');
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$path,
            'status'=>$request->status,
        ]);
        $request->session()->flash('success','商家分类添加成功');
        return redirect()->route('shop_categories.index');
    }

    public function edit(ShopCategory$shopCategory){

        return view('shopcategory.edit',compact('shopCategory'));
    }
    public function update(Request$request,ShopCategory$shopCategory){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'status'=>'请选择状态'
        ]);
        $img=$request->file('img');
        if($img){
            $path=$img->store('public/shop_category');
        }else{
            $path = $shopCategory->img;
        }
        $shopCategory->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$path
        ]);
        $request->session()->flash('success','商家分类修改成功');
        return redirect()->route('shop_categories.index');
    }

    public function destroy(ShopCategory$shopCategory){
        $shopCategory->delete();
        session()->flash('success','商品分类删除成功');
        return redirect()->route('shop_categories.index');
    }
}
