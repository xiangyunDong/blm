@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>活动名</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
           <td>{{$activity->start_time}}</td>
            <td>{{$activity->end_time}}</td>
            <td><a href="{{route('activities.show',[$activity])}}">查看详情</a>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $activities->links() }}
    @stop