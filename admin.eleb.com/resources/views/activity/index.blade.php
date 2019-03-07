@extends('layout.app')
@section('contents')
    <form class="navbar-form navbar-left" method="get" action="{{route('activities.index')}}">
        <div class="form-group">
            <select class="form-control" name="keyword">
                <option  value="1">未开始</option>
                <option  value="2">进行中</option>
                <option  value="-1">已结束</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
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