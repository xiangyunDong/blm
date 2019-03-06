@extends('layout.app')
@section('contents')
    <h1>管理员账号注册页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('admins.store')}}" >
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>邮箱</label>
        <input class="form-control" type="text" name="email" value="{{old('email')}}">
        <label>密码</label>
        <input class="form-control" type="password" name="password" value="{{old('password')}}">
        <label>角色</label>
        <div class="form-control">
            @foreach($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->name}}">{{$role->name}}
            @endforeach
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;