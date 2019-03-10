<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create(){
        return view('permission.create');
    }
    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'权限名不能为空',
        ]);
        Permission::create([
            'name'=>$request->name,
        ]);
        $request->session()->flash('success','权限添加成功');
        return redirect()->route('permissions.create');
    }

   public function index(){
        $permissions=Permission::paginate(10);
        return view('permission.index',compact('permissions'));
   }

   public function edit(Permission$permission){

        return view('permission.edit',compact('permission'));
   }
   public function update(Request $request, Permission$permission)
       {
           $this->validate($request,[
               'name'=>'required',
           ],[
               'name.required'=>'权限名不能为空',
           ]);
           $permission->update([
               'name' => $request->name,
           ]);
           $request->session()->flash('success', '权限修改成功');
           return redirect()->route('permissions.index');
       }

    public function destroy(Permission$permission){
        $permission->delete();
        session()->flash('success','权限删除成功');
        return redirect()->route('permissions.index');
    }
   }

