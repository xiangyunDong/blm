<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        $activities=Activity::where('end_time','>',date("Y-m-d h:m:s"))->paginate(3);
        return view('activity.index',compact('activities'));
    }
    public function show(Request$request,Activity$activity){
        dd($activity['attributes']['content']);
        //dd($request->items()[0]['attributes']['goods_name']);
    }
}
