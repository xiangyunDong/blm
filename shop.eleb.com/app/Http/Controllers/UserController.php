<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users=User::paginate(3);
        return view('user.index',compact('users'));
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $img=$request->file('shop_img');
        $path=$img->store('public/shop');
        $shop=new Shop();
            $shop->shop_category_id=$request->shop_category_id;
            $shop->shop_name=$request->shop_name;
            $shop->shop_img=url(Storage::url($path));
            $shop->shop_rating=$request->shop_rating;
            $shop->brand=$request->brand;
            $shop->on_time=$request->on_time;
            $shop->fengniao=$request->fengniao;
            $shop->bao=$request->bao;
            $shop->piao=$request->piao;
            $shop->zhun=$request->zhun;
            $shop->start_send=$request->start_send;
            $shop->send_cost=$request->send_cost;
            $shop->notice=$request->notice;
            $shop->discount=$request->discount;
            $shop->status=0;
            $shop->save();
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->status=1;
            $user->shop_id=$shop->id;
            $user->save();
        $request->session()->flash('success','注册成功');
        return redirect()->route('users.index');
    }
    public function password(){
        $user=Auth::user();
        return view('user.password',compact('user'));
    }
    public function password1(Request$request){
        $this->validate($request,[
            'password'=>'required',
            'new_password'=>'required|confirmed',
            'new_password_confirmation'=>'required',
        ]);
            $user=Auth::user();
        if (Hash::check($request->password,$user->password)) {
            $user->password=Hash::make($request->new_password);
            $user->save();
            session()->flash('success','密码修改成功');
            Auth::logout();
        }else{
            session()->flash('danger','原密码不一致');
        }
        return redirect()->route('login');

    }
}
