@extends('layout.app')
@section('contents')
    <h1>菜品分类添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('menu_categories.store')}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>菜品编号</label>
        <input class="form-control" type="text" name="type_accumulation" value="{{old('type_accumulation')}}">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
                <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <label>描述</label>
        <input class="form-control" type="text" name="description" value="{{old('description')}}">
        <label>是否是默认分类</label>
        <div class="form-control">
        <input  type="radio" name="is_selected" value="1">是
        <input  type="radio" name="is_selected" value="0">否
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;