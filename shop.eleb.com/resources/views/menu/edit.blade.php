@extends('layout.app')
@section('contents')
    @include('layout.img')
    <h1>菜品修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('menus.update',[$menu])}}" enctype="multipart/form-data">
        <label>名称</label>
        <input class="form-control" type="text" name="goods_name" value="{{$menu->goods_name}}">
        <label>评分</label>
        <input class="form-control" type="text" name="rating" value="{{$menu->rating}}">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
                <option value="{{$shop->id}}"
                @if($shop->id==$menu->shop_id)selected @endif
                >{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <label>所属菜品分类</label>
        <select class="form-control" name="category_id">
            @foreach($menu_categories as $menu_category)
                <option value="{{$menu_category->id}}"
                        @if($menu_category->id==$menu->category_id)selected @endif
                >{{$menu_category->name}}</option>
            @endforeach
        </select>
        <label>价格</label>
        <input class="form-control" type="text" name="goods_price" value="{{$menu->goods_price}}">
        <label>描述</label>
        <input class="form-control" type="text" name="description" value="{{$menu->description}}">
        <label>月销量</label>
        <input class="form-control" type="text" name="month_sales" value="{{$menu->month_sales}}">
        <label>评分数量</label>
        <input class="form-control" type="text" name="rating_count" value="{{$menu->rating_count}}">
        <label>提示信息</label>
        <input class="form-control" type="text" name="tips" value="{{$menu->tips}}">
        <label>满意度数量</label>
        <input class="form-control" type="text" name="satisfy_count" value="{{$menu->satisfy_count}}">
        <label>满意度评分</label>
        <input class="form-control" type="text" name="satisfy_rate" value="{{$menu->satisfy_rate}}">
        <label>图片</label>
        <input type="hidden" name="goods_img" id="img_val">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <td><img id="img" width="50" name="img"></td>
        </div>
        <label>原图片</label>
        <div>
            <td><img src="{{$menu->goods_img}}" style="width: 50px" ></td>
        </div>
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1" @if($menu->status==1)checked @endif>上架
            <input  type="radio" name="status" value="0" @if($menu->status==0)checked @endif>下架
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @include('layout.img_script')
@stop;