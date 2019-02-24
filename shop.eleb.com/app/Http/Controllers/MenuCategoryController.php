<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuCategory;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $menu_categories=MenuCategory::paginate(3);
        return view('menucategory.index',compact('menu_categories'));
    }

    public function create(){
        $shops=Shop::all();
        return view('menucategory.create',compact('shops'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'shop_id'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
        ]);
        $menu_category= new MenuCategory();
            $menu_category->name=$request->name;
            $menu_category->type_accumulation=$request->type_accumulation;
            $menu_category->shop_id=$request->shop_id;
            $menu_category->description=$request->description;
            $menu_category->is_selected=$request->is_selected;
            if($menu_category->is_selected==1){
                DB::table('menu_categories')->where([['is_selected','=',1],['shop_id','=',$request->shop_id]])->update(['is_selected' =>0]);
            }
            $menu_category->save();

        $request->session()->flash('success','菜品分类添加成功');
        return redirect()->route('menu_categories.index');
    }

    public function edit(MenuCategory$menuCategory){
        $shops=Shop::all();
        return view('menucategory.edit',compact('menuCategory','shops'));
    }
    public function update(Request$request,MenuCategory$menuCategory){
        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'shop_id'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
        ]);

        $menuCategory->name=$request->name;
        $menuCategory->type_accumulation=$request->type_accumulation;
        $menuCategory->shop_id=$request->shop_id;
        $menuCategory->description=$request->description;
        $menuCategory->is_selected=$request->is_selected;
        if($menuCategory->is_selected==1){
            DB::table('menu_categories')->where([['is_selected',1],['shop_id',$request->shop_id]])->update(['is_selected' =>0]);
        }
        $menuCategory->save();
        $request->session()->flash('success','菜品分类修改成功');
        return redirect()->route('menu_categories.index');
    }

    public function destroy(MenuCategory$menuCategory){
        $a=DB::table('menus')->where('category_id',$menuCategory->id)->first();
        if ($a){
            session()->flash('success','该分类下还有菜品，不能删除分类');
            return redirect()->route('menu_categories.index');
        }
        $menuCategory->delete();
        session()->flash('success','菜品分类删除成功');
        return redirect()->route('menu_categories.index');
    }
}
