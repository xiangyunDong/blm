@extends('layout.app')
@section('contents')
    <h1>角色添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('roles.store')}}" >
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>权限</label>
        <div class="form-control">
            @foreach($permissions as $permission)
        <input type="checkbox" name="permissions[]" value="{{$permission->name}}">{{$permission->name}}
            @endforeach
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;