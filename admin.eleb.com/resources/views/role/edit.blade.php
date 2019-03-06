@extends('layout.app')
@section('contents')
    <h1>角色修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('roles.update',[$role])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$role->name}}">
        <label>权限</label>
        <div class="form-control">
            @foreach($permissions as $permission):
                <input type="checkbox" name="permissions[]" value="{{$permission->name}}"
                       @if($role->hasPermissionTo($permission->name)) checked @endif
                >{{$permission->name}}
            @endforeach;
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;