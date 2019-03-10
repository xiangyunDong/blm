@extends('layout.app')
@section('contents')
    <h1>活动修改页面</h1>
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form class="form-group" method="post" action="{{route('events.update',[$event])}}">
        <label>活动名</label>
        <input class="form-control" type="text" name="title" value="{{$event->title}}">
        <label>内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <script id="container" name="content" type="text/plain" >{!!$event->content!!}</script>
        <label>报名开始时间</label>
        <input type="date" class="form-control" name="signup_start" value="{{date("Y-m-d",$event->signup_start)}}">
        <label>报名结束时间</label>
        <input type="date" class="form-control" name="signup_end" value="{{date("Y-m-d",$event->signup_end)}}">
        <label>开奖日期</label>
        <input type="date" class="form-control" name="prize_date" value="{{substr($event->prize_date,0,10)}}">
        <label>报名人数限制</label>
        <input type="text" class="form-control" name="signup_num" value="{{$event->signup_num}}">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;