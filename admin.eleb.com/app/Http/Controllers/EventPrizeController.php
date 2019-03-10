<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $event_prizes=EventPrize::paginate(10);
        return view('event_prize.index',compact('event_prizes'));
    }

    public function create(){
        $events=Event::all();
        return view('event_prize.create',compact('events'));
    }

    public function store(Request$request){
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',
        ]);

        EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        $request->session()->flash('success','奖品添加成功');
        return redirect()->route('event_prizes.index');
    }

    public function edit(EventPrize$eventPrize){
        $events=Event::all();
        return view('event_prize.edit',compact('eventPrize','events'));
    }
    public function update(Request$request,EventPrize$eventPrize){
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',
        ]);

        $eventPrize->update([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
        ]);
        $request->session()->flash('success','奖品修改成功');
        return redirect()->route('event_prizes.index');
    }

    public function destroy(EventPrize$eventPrize){
        $eventPrize->delete();
        session()->flash('success','奖品删除成功');
        return redirect()->route('event_prizes.index');
    }

}
