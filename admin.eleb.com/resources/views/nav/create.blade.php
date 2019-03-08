@extends('layout.app')
@section('contents')
    <h1>菜单添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('navs.store')}}" >
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>地址路由</label>
        <input class="form-control" type="text" name="url" value="{{old('url')}}">
        <label>上级菜单</label>
        <select class="form-control" name="pid">
            <option value="0">顶级菜单</option>
            @foreach($navs as $nav)
                <option value="{{$nav->id}}">{{$nav->name}}</option>
            @endforeach
        </select>
        <label>对应权限</label>
        <select class="form-control" name="permission_id">
            <option value="0">无权限</option>
            @foreach($permissions as $permission)
                <option value="{{$permission->id}}">{{$permission->name}}</option>
            @endforeach
        </select>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;