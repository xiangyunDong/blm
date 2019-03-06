<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
    $admins=Admin::paginate(3);
    return view('admin.index',compact('admins'));
}

    public function create(){
        return view('admin.create');
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',
        ]);

        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        $request->session()->flash('success','管理员账号添加成功');
        return redirect()->route('admins.index');
    }

    public function edit(Admin$admin){
        return view('admin.edit',compact('admin'));
    }
    public function update(Request$request,Admin$admin){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
        ]);

        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        $request->session()->flash('success','商家账号修改成功');
        return redirect()->route('admins.index');
    }

    public function destroy(Admin$admin){
        $admin->delete();
        session()->flash('success','商家账号删除成功');
        return redirect()->route('admins.index');
    }
    public function password(){
        $admin=Auth::user();
        return view('admin.password',compact('admin'));
    }
    public function password1(Request$request){
        $this->validate($request,[
            'password'=>'required',
            'new_password'=>'required|confirmed',
            'new_password_confirmation'=>'required',
        ]);
            $admin=Auth::user();
        if (Hash::check($request->password,$admin->password)) {
                $admin->password=Hash::make($request->new_password);
                $admin->save();
            session()->flash('success','密码修改成功');
            Auth::logout();
        }else{
            session()->flash('danger','原密码不一致');
        }
        return redirect()->route('login');

    }


}
