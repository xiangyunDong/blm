@extends('layout.app')
@section('contents')
    <h1>修改密码</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('admins.password1',[$admin])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$admin->name}}">
        <label>原密码</label>
        <input class="form-control" type="password" name="password">
        <label>新密码</label>
        <input class="form-control" type="password" name="new_password">
        <label>确认密码</label>
        <input class="form-control" type="password" name="new_password_confirmation">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;