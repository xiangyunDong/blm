<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function create(){
        return view('login.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ]);
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,

        ],$request->has('rememberMe'))){
            return redirect()->route('admins.index')->with('success','登陆成功');
        }else{
            return back()->with('danger','用户名或密码错误');
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }
}
