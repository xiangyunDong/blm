<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function create(){
        $permissions=Permission::all();
        return view('role.create',compact('permissions'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'角色名不能为空',
        ]);
        //dd($request->permissions);
        $role=Role::create([
            'name'=>$request->name,
        ]);
        $role -> syncPermissions($request->permissions);
        $request->session()->flash('success','角色添加成功');
        return redirect()->route('roles.create');
    }

    public function index(){
        $roles=Role::paginate(10);
        return view('role.index',compact('roles'));
    }
    public function edit(Role$role){
        $permissions=Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Request$request,Role$role){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'角色名不能为空',
        ]);
        $role->update([
            'name'=>$request->name,
        ]);
        $role -> syncPermissions($request->permissions);
        $request->session()->flash('success','角色修改成功');
        return redirect()->route('roles.index');
    }
    public function destroy(Role$role){
        $role->delete();
        session()->flash('success','角色删除成功');
        return redirect()->route('roles.index');
    }
}
