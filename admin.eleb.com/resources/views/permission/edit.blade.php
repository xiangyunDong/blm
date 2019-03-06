@extends('layout.app')
@section('contents')
    <h1>管理员账号修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('permissions.update',[$permission])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$permission->name}}">
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;