@extends('layout.app')
@section('contents')
    <h1>奖品添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('event_prizes.store')}}" >
        <label>活动id</label>
        <select class="form-control" name="events_id">
            @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
            @endforeach
        </select>
        <label>奖品名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>奖品详情</label>
        <input class="form-control" type="text" name="description" value="{{old('description')}}">
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;