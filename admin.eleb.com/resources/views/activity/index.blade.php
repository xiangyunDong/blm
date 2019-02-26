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
            <td><a href="{{route('activities.edit',[$activity])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('activities.destroy',[$activity])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $activities->appends(['keyword'=>$keyword])->links() }}
    @stop