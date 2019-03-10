<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMember;
use App\EventPrize;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
            $events=Event::paginate(3);
        return view('event.index',compact('events'));
    }


    public function create(){
        return view('event.create');
    }

    public function store(Request$request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ]);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start) ,
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        $request->session()->flash('success','活动添加成功');
        return redirect()->route('events.index');
    }

    public function edit(Event$event){
        //dd($activity);
        return view('event.edit',compact('event'));
    }
    public function update(Request$request,Event$event){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ]);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start) ,
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        $request->session()->flash('success','抽奖修改成功');
        return redirect()->route('events.index');
    }

    public function destroy(Event$event){
        $event_prizes=EventPrize::where('events_id',$event->id)->get();
        $event_members=EventMember::where('events_id',$event->id)->get()->toArray();

        foreach ($event_prizes as $event_prize):
            shuffle($event_members);
            $member=array_pop($event_members);
            $event_prize->member_id=$member['member_id'];
            $event_prize->save();
            endforeach;
            $event->is_prize=1;
            $event->save();
        $event_prizes=EventPrize::where('events_id',$event->id)->paginate(10);
        session()->flash('success','开奖成功');
        return view('event_prize.index',compact('event_prizes'));
    }
}
