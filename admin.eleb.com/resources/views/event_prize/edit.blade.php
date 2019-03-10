@extends('layout.app')
@section('contents')
    <h1>奖品修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('event_prizes.update',[$eventPrize])}}" >
        <label>活动id</label>
        <select class="form-control" name="events_id">
            @foreach($events as $event)
                <option value="{{$event->id}}"
                @if($eventPrize->events_id==$event->id) selected @endif
                >{{$event->title}}</option>
            @endforeach
        </select>
        <label>奖品名称</label>
        <input class="form-control" type="text" name="name" value="{{$eventPrize->name}}">
        <label>奖品详情</label>
        <input class="form-control" type="text" name="description" value="{{$eventPrize->description}}">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;