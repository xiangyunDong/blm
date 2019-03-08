@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>活动名</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
           <td>{{date("Y-m-d H:i:s",$event->signup_start)}}</td>
            <td>{{date("Y-m-d H:i:s",$event->signup_end)}}</td>
            <td>{{$event->prize_date}}</td>
            <td>{{$event->signup_num}}</td>
            <td>{{$event->is_prize}}</td>
            <td>
                <form method="post" style="display: inline" action="{{route('events.destroy',[$event])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">立即报名</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $events->links() }}
    @stop