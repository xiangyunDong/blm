<?php

namespace App\Http\Controllers;

use App\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'
        );
    }
    public function index(){
        $event_members=EventMember::paginate(10);
        return view('event_member.index',compact('event_members'));
    }
}
