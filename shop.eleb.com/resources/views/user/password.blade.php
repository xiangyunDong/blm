@extends('layout.app')
@section('contents')
    <h1>修改密码</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('users.password1',[$user])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$user->name}}">
        <label>原密码</label>
        <input class="form-control" type="password" name="password">
        <label>新密码</label>
        <input class="form-control" type="password" name="password1">
        <label>确认密码</label>
        <input class="form-control" type="password" name="password2">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;