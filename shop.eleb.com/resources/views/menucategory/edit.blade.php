@extends('layout.app')
@section('contents')
    <h1>菜品分类修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('menu_categories.update',[$menuCategory])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$menuCategory->name}}">
        <label>菜品编号</label>
        <input class="form-control" type="text" name="type_accumulation" value="{{$menuCategory->type_accumulation}}">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
                <option value="{{$shop->id}}"
                @if($shop->id==$menuCategory->shop_id) selected @endif
                >{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <label>描述</label>
        <input class="form-control" type="text" name="description" value="{{$menuCategory->name}}">
        <label>是否是默认分类</label>
        <div class="form-control">
            <input  type="radio" name="is_selected" value="1" @if($menuCategory->is_selected==1)checked @endif>是
            <input  type="radio" name="is_selected" value="0" @if($menuCategory->is_selected==0)checked @endif>否
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;