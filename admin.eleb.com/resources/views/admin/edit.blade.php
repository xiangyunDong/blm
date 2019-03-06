@extends('layout.app')
@section('contents')
    <h1>管理员账号修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('admins.update',[$admin])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$admin->name}}">
        <label>邮箱</label>
        <input class="form-control" type="text" name="email" value="{{$admin->email}}">
        <label>角色</label>
        <div class="form-control">
            @foreach($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->name}}"
                       @if($admin->hasRole($role->name)) checked @endif
                >{{$role->name}}
            @endforeach
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;