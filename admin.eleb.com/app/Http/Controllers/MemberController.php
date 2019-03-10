<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }

    public function index(Request$request){
        $keyword=$request->keyword;
        if ($keyword){
            $members=Member::where('username','like',"%$keyword%")
                ->orWhere('tel', 'like',"%$keyword%")->paginate(3);
            return view('member.index',compact('members','keyword'));
        }
        $keyword='';
        $members=Member::paginate(3);
        return view('member.index',compact('members','keyword'));
    }

    public function reset(Member$member){
        if($member->status==1){
            $member->status=0;
            $member->save();
        }else{
            $member->status=1;
            $member->save();
        }
        session()->flash('success','会员状态修改成功');
        return redirect()->route('members.index');
    }

    public function show(Member$member){
        dd($member);
    }

    public function destroy(Member$member){
        $member->delete();
        session()->flash('success','会员账号删除成功');
        return redirect()->route('members.index');
    }
}
