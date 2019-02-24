@extends('layout.app')
@section('contents')
    <h1>菜品添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('menus.store')}}" enctype="multipart/form-data">
        <label>名称</label>
        <input class="form-control" type="text" name="goods_name" value="{{old('goods_name')}}">
        <label>评分</label>
        <input class="form-control" type="text" name="rating">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
            <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                @endforeach
        </select>
        <label>所属菜品分类</label>
        <select class="form-control" name="category_id">
            @foreach($menu_categories as $menu_category)
                <option value="{{$menu_category->id}}">{{$menu_category->name}}</option>
            @endforeach
        </select>
        <label>价格</label>
        <input class="form-control" type="text" name="goods_price" value="{{old('goods_price')}}">
        <label>描述</label>
        <input class="form-control" type="text" name="description" value="{{old('description')}}">
        <label>月销量</label>
        <input class="form-control" type="text" name="month_sales" value="{{old('month_sales')}}">
        <label>评分数量</label>
        <input class="form-control" type="text" name="rating_count" value="{{old('rating_count')}}">
        <label>提示信息</label>
        <input class="form-control" type="text" name="tips" value="{{old('tips')}}">
        <label>满意度数量</label>
        <input class="form-control" type="text" name="satisfy_count" value="{{old('satisfy_count')}}">
        <label>满意度评分</label>
        <input class="form-control" type="text" name="satisfy_rate" value="{{old('satisfy_rate')}}">
        <label>商品图片</label>
        <input class="form-control" type="file" name="goods_img">
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1">上架
            <input  type="radio" name="status" value="0">下架
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;