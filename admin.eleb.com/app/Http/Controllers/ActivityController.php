<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(Request$request){
       //dd(date("Y-m-d h:m:s"));
        if($request->keyword){
            $keyword=$request->keyword;
            $wheres=[];
            //dd($keyword);
            if ($keyword==1) $wheres[]=['start_time','>',date("Y-m-d h:m:s")];
            if ($keyword==2){
                $wheres[]=['start_time','<',date("Y-m-d h:m:s")];
                $wheres[]=['end_time','>',date("Y-m-d h:m:s")];
            }
            if ($keyword==-1) $wheres[]=['end_time','<',date("Y-m-d h:m:s")];
            $activities=Activity::where($wheres)->paginate(3);
        }else{
            $activities=Activity::paginate(3);
            $keyword='';
        }

        return view('activity.index',compact('activities','keyword'));
    }


    public function create(){
        return view('activity.create');
    }

    public function store(Request$request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名不能为空'
        ]);
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        $request->session()->flash('success','活动添加成功');
        return redirect()->route('activities.index');
    }

    public function edit(Activity$activity){
            //dd($activity);
        return view('activity.edit',compact('activity'));
    }
    public function update(Request$request,Activity$activity){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名不能为空'
        ]);
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        $request->session()->flash('success','活动修改成功');
        return redirect()->route('activities.index');
    }

    public function destroy(Activity$activity){
        $activity->delete();
        session()->flash('success','活动删除成功');
        return redirect()->route('activities.index');
    }
}
