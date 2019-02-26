@extends('layout.app')
@section('contents')
    @include('layout.img')
    <h1>商家分类修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('shop_categories.update',[$shopCategory])}}"enctype="multipart/form-data">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$shopCategory->name}}" >
        <label>图片</label>
        <input type="hidden" name="img" id="img_val">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <td><img id="img" width="50" name="img"></td>
        </div>
        <label>原图片</label>
        <div>
        <td><img src="{{$shopCategory->img}}" style="width: 50px" ></td>
        </div>
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1" @if($shopCategory->status==1) checked @endif>显示
            <input  type="radio" name="status" value="0" @if($shopCategory->status==0) checked @endif>隐藏
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @include('layout.img_script')
@stop;