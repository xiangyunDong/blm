@extends('layout.app')
@section('contents')
    <h1>商家分类添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('shop_categories.store')}}" enctype="multipart/form-data">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>图片</label>
        <input class="form-control" type="file" name="img">
        <label>状态</label>
        <div class="form-control">
        <input  type="radio" name="status" value="1">显示
        <input  type="radio" name="status" value="0">隐藏
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;