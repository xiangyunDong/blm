@extends('layout.app')
@section('contents')
    @include('layout.img')
    <h1>商家添加页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
        <label>所属商家分类</label>
        <select class="form-control" name="shop_category_id">
            @foreach($shop_categories as $shop_category)
            <option value="{{$shop_category->id}}">{{$shop_category->name}}</option>
                @endforeach
        </select>
        <label>名称</label>
        <input class="form-control" type="text" name="shop_name" value="{{old('shop_name')}}">
        <label>店铺图片</label>
        <input type="hidden" name="shop_img" id="img_val">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <td><img id="img" width="50" name="img"></td>
        </div>
        <label>评分</label>
        <input class="form-control" type="text" name="shop_rating">
        <label>是否品牌</label>
        <div class="form-control">
        <input  type="radio" name="brand" value="1">是
        <input  type="radio" name="brand" value="0">否
        </div>
        <label>是否准时送达</label>
        <div class="form-control">
            <input  type="radio" name="on_time" value="1">是
            <input  type="radio" name="on_time" value="0">否
        </div>
        <label>是否蜂鸟配送</label>
        <div class="form-control">
            <input  type="radio" name="fengniao" value="1">是
            <input  type="radio" name="fengniao" value="0">否
        </div>
        <label>是否保标记</label>
        <div class="form-control">
            <input  type="radio" name="bao" value="1">是
            <input  type="radio" name="bao" value="0">否
        </div>
        <label>是否准标记</label>
        <div class="form-control">
            <input  type="radio" name="zhun" value="1">是
            <input  type="radio" name="zhun" value="0">否
        </div>
        <label>是否票标记</label>
        <div class="form-control">
            <input  type="radio" name="piao" value="1">是
            <input  type="radio" name="piao" value="0">否
        </div>
        <label>起送金额</label>
        <input class="form-control" type="text" name="start_send" value="{{old('start_send')}}">
        <label>配送费</label>
        <input class="form-control" type="text" name="send_cost" value="{{old('send_cost')}}">
        <label>店公告</label>
        <input class="form-control" type="text" name="notice" value="{{old('notice')}}">
        <label>优惠信息</label>
        <input class="form-control" type="text" name="discount" value="{{old('discount')}}">
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1">正常
            <input  type="radio" name="status" value="0">待审核
            <input  type="radio" name="status" value="-1">禁用
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @include('layout.img_script')
    @stop;