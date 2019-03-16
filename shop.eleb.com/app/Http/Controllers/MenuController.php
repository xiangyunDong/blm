<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuCategory;
use App\Order;
use App\OrderDetail;
use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(Request$request){
        $keyword=$request->keyword;
        if ($keyword){
            $cl = new \App\SphinxClient();
            $cl->SetServer ( '127.0.0.1', 9312);
            $cl->SetConnectTimeout ( 10 );
            $cl->SetArrayResult ( true );
            $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
            $cl->SetLimits(0, 1000);
            $info = $keyword;
            $res = $cl->Query($info, 'menus');
            $ids=[];
            if (isset($res['matches'])){
                foreach ($res['matches'] as $r):
                    $ids[]=$r['id'];
                endforeach;
                $menus=Menu::wherein('id',$ids)->paginate(3);
                return view('menu.index',compact('menus','keyword'));
            }
        }
            $menus=Menu::paginate(3);
            $keyword='';
        return view('menu.index',compact('menus','keyword'));
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
            'status'=>'required',
        ]);
        //图片处理
        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'goods_img'=>$request->goods_img,
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
    public function update(Request$request,Menu$menu){
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
        $menu->update([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'goods_img'=>$request->goods_img,
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
    public function upload(Request$request){
        $img=$request->file('file');
        $path=Storage::url($img->store('public/menus'));
        return ['path'=>$path];
    }

    public function count(Request$request)
    {
        $keyword = $request->keyword;
            $shop_id=Auth::user()->shop_id;
        if ($keyword == 1) {
            $title = "近一周菜品销量";
            $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
            $time_end=date('Y-m-d 23:59:59');
            $sql="select date(orders.created_at) as date,order_details.goods_name,sum(order_details.amount) as sum
            from orders join order_details on orders.id=order_details.order_id
            where orders.created_at between '$time_start' and '$time_end'and orders.shop_id=$shop_id
            group by order_details.goods_name,date(orders.created_at)";
            $rows=DB::select($sql);
            //dd($rows);
            $datas=[];
            foreach ($rows as $row):
            for ($i=0;$i<7;$i++):
                $datas[$row->goods_name][date('Y-m-d',strtotime("-{$i} day"))]=0;
            endfor;
            endforeach;
            foreach ($rows as $row):
                $datas[$row->goods_name][$row->date]+=$row->sum;
            endforeach;
            //dd($datas);
            $series=[];
            foreach ($datas as $k=>$v):
            $serie=[
                'name'=>$k,
            'type'=>'line',
            'stack'=>'销量',
             'areaStyle'=>'{}',
            'data'=>array_values($v)
            ];
            $series[]=$serie;
            endforeach;
            //dd($series);
            return view('menu.count',compact('title','series'));
        } elseif ($keyword == 2) {
            $title = "近三月菜品销量";

            return view('menu.count', compact('title', 'datas'));
        } elseif ($keyword == -1) {

            return view('menu.count', compact('title', 'datas'));
        }
    }

}
