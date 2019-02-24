<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create(){
        return view('login.create');
    }

    public function store(Request $request,User$user){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ]);
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,

        ],$request->has('rememberMe'))){
            if(Auth()->user()->shop->status==1){
                return redirect()->route('users.index')->with('success','登陆成功');
            }else{
                return back()->with('danger','商家非正常状态');
            }

        }else{
            return back()->with('danger','用户名或密码错误');
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }
}
