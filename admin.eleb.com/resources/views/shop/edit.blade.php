@extends('layout.app')
@section('contents')
    @include('layout.img')
    <h1>商家修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('shops.update',[$shop])}}" enctype="multipart/form-data">
        <label>所属商家分类</label>
        <select class="form-control" name="shop_category_id">
            @foreach($shop_categories as $shop_category)
                <option value="{{$shop_category->id}}"
                    @if($shop->shop_category_id==$shop_category->id) selected @endif>
                    {{$shop_category->name}}</option>
            @endforeach
        </select>
        <label>名称</label>
        <input class="form-control" type="text" name="shop_name" value="{{$shop->shop_name}}">
        <label>图片</label>
        <input type="hidden" name="shop_img" id="img_val">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <td><img id="img" width="50" name="img"></td>
        </div>
        <label>原图片</label>
        <div>
            <td><img src="{{$shop->shop_img}}" style="width: 50px" ></td>
        <label>评分</label>
        <input class="form-control" type="text" name="shop_rating" value="{{$shop->shop_rating}}">
        <label>是否品牌</label>
        <div class="form-control">
            <input  type="radio" name="brand" value="1" @if($shop->brand==1)checked @endif>是
            <input  type="radio" name="brand" value="0" @if($shop->brand==0)checked @endif>否
        </div>
        <label>是否准时送达</label>
        <div class="form-control">
            <input  type="radio" name="on_time" value="1" @if($shop->on_time==1)checked @endif>是
            <input  type="radio" name="on_time" value="0" @if($shop->on_time==0)checked @endif>否
        </div>
        <label>是否蜂鸟配送</label>
        <div class="form-control">
            <input  type="radio" name="fengniao" value="1" @if($shop->fengniao==1)checked @endif>是
            <input  type="radio" name="fengniao" value="0" @if($shop->fengniao==0)checked @endif>否
        </div>
        <label>是否保标记</label>
        <div class="form-control">
            <input  type="radio" name="bao" value="1" @if($shop->bao==1)checked @endif>是
            <input  type="radio" name="bao" value="0" @if($shop->bao==0)checked @endif>否
        </div>
        <label>是否准标记</label>
        <div class="form-control">
            <input  type="radio" name="zhun" value="1" @if($shop->zhun==1)checked @endif>是
            <input  type="radio" name="zhun" value="0" @if($shop->zhun==0)checked @endif>否
        </div>
        <label>是否票标记</label>
        <div class="form-control">
            <input  type="radio" name="piao" value="1" @if($shop->piao==1)checked @endif>是
            <input  type="radio" name="piao" value="0" @if($shop->piao==0)checked @endif>否
        </div>
        <label>起送金额</label>
        <input class="form-control" type="text" name="start_send" value="{{$shop->start_send}}">
        <label>配送费</label>
        <input class="form-control" type="text" name="send_cost" value="{{$shop->send_cost}}">
        <label>店公告</label>
        <input class="form-control" type="text" name="notice" value="{{$shop->notice}}">
        <label>优惠信息</label>
        <input class="form-control" type="text" name="discount" value="{{$shop->discount}}">
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1" @if($shop->status==1)checked @endif>正常
            <input  type="radio" name="status" value="0" @if($shop->status==0)checked @endif>待审核
            <input  type="radio" name="status" value="-1" @if($shop->status==-1)checked @endif>禁用
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @include('layout.img_script')
@stop;