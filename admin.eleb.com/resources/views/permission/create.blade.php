@extends('layout.app')
@section('contents')
    <h1>权限添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('permissions.store')}}" >
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;