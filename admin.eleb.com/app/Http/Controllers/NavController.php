<?php

namespace App\Http\Controllers;

use App\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $navs=Nav::paginate(10);
        return view('nav.index',compact('navs'));
    }

    public function create(){
        $permissions=Permission::all();
        $navs=Nav::where('pid',0)->get();
        return view('nav.create',compact('navs','permissions'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'pid'=>'required',
        ]);
        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url?$request->url:0,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid,
        ]);
        $request->session()->flash('success','菜单添加成功');
        return redirect()->route('navs.index');
    }

    public function edit(Nav$nav){
        $permissions=Permission::all();
        $navs=Nav::where('pid',0)->get();
        return view('nav.edit',compact('nav','navs','permissions'));
    }
    public function update(Request$request,Nav$nav){
        $this->validate($request,[
            'name'=>'required',
            'pid'=>'required',
        ]);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url?$request->url:0,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid,
        ]);
        $request->session()->flash('success','菜单修改成功');
        return redirect()->route('navs.index');
    }

    public function destroy(Nav$nav){
        $nav->delete();
        session()->flash('success','菜单删除成功');
        return redirect()->route('navs.index');
}}
