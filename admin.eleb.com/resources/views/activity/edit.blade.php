@extends('layout.app')
@section('contents')
    <h1>活动修改页面</h1>
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form class="form-group" method="post" action="{{route('activities.update',[$activity])}}">
        <label>活动名</label>
        <input class="form-control" type="text" name="title" value="{{$activity->title}}">
        <label>内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <script id="container" name="content" type="text/plain" >{!!$activity->content!!}</script>
        <label>活动开始时间</label>
        <input type="date" class="form-control" name="start_time" value="{{substr($activity->start_time,0,10)}}">
        <label>活动结束时间</label>
        <input type="date" class="form-control" name="end_time" value="{{substr($activity->end_time,0,10)}}">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;