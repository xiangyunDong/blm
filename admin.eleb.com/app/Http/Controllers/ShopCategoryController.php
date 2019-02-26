<?php

namespace App\Http\Controllers;

use App\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
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
            'status'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'status'=>'请选择状态'
        ]);
        //图片处理
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$request->img,
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
        $shopCategory->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$request->img,
        ]);
        $request->session()->flash('success','商家分类修改成功');
        return redirect()->route('shop_categories.index');
    }

    public function destroy(ShopCategory$shopCategory){
        $shopCategory->delete();
        session()->flash('success','商品分类删除成功');
        return redirect()->route('shop_categories.index');
    }

    public function upload(Request$request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/shop_categorys'));
        return ['path'=>$path];
    }
}
