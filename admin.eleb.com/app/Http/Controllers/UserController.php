<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
{
    $this->middleware('auth'
    );
}
    public function index(){
        $users=User::paginate(3);
        return view('user.index',compact('users'));
    }

    public function create(){
        $shops=Shop::all();
        return view('user.create',compact('shops'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'status'=>'required',
            'shop_id'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',
            'status'=>'请选择状态',
            'shop_id'=>'所属商家不能为空',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,
        ]);
        $request->session()->flash('success','商家账号添加成功');
        return redirect()->route('users.index');
    }

    public function edit(User$user){
        $shops=Shop::all();
        return view('user.edit',compact('user','shops'));
    }
    public function update(Request$request,User$user){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'status'=>'required',
            'shop_id'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'status'=>'请选择状态',
            'shop_id'=>'所属商家不能为空',
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,
        ]);
        $request->session()->flash('success','商家账号修改成功');
        return redirect()->route('users.index');
    }

    public function destroy(User$user){
        $user->delete();
        session()->flash('success','商家账号删除成功');
        return redirect()->route('users.index');
    }


    public function reset(User$user){
        $user->password=Hash::make('000000');
        $user->save();
        session()->flash('success','商家密码重置成功，密码为000000');
        return redirect()->route('users.index');
    }
}
