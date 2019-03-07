@extends('layout.app')
@section('contents')
    <h1>菜单修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('navs.update',[$nav])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$nav->name}}">
        <label>地址路由</label>
        <input class="form-control" type="text" name="url" value="{{$nav->url}}">
        <label>上级菜单</label>
        <select class="form-control" name="pid">
            <option value="0">顶级菜单</option>
            @foreach($navs as $n)
                <option value="{{$n->id}}"
                        @if($nav->pid==$n->id) selected @endif>
                {{$n->name}}</option>
            @endforeach
        </select>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;