@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>活动id</th>
            <th>奖品名称</th>
            <th>中奖商家</th>
            <th>操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
        <tr>
            <td>{{$event_prize->id}}</td>
            <td>{{$event_prize->events_id}}</td>
            <td>{{$event_prize->name}}</td>
            <td>{{$event_prize->member_id}}</td>
            <td>@can('event_prizes.edit')
                <a href="{{route('event_prizes.edit',[$event_prize])}}">编辑</a>
                @endcan
                @can('event_prizes.destory')
                <form method="post" style="display: inline" action="{{route('event_prizes.destroy',[$event_prize])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
                    @endcan
            </td>
        </tr>
            @endforeach
    </table>
    {{ $event_prizes->links() }}
    @stop