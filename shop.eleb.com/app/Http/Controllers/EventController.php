<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMember;
use App\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(){
        $events=Event::paginate(10);
        return view('event.index',compact('events'));
    }

    public function destroy(Event$event){
        $is=EventMember::where('events_id',$event->id)->where('member_id',Auth::user()->id)->count();
        $num=EventMember::where('events_id',$event->id)->count();
        if ($num<$event->signup_num&&$is==0){
            EventMember::create([
                'events_id'=>$event->id,
                'member_id'=>Auth::user()->id,
            ]);
            $events=Event::paginate(10);
            return view('event.index',compact('events'));
        }else{
            $events=Event::paginate(10);
            session()->flash('danger','报名失败，人数已满');
            return view('event.index',compact('events'));
        }
    }
}
