@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>分类</th>
            <th>店铺名</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->shop_category->name}}</td>
            <td>{{$shop->shop_name}}</td>
            <td><img src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}"style="width: 50px" ></td>
            <td>{{$shop->shop_rating}}</td>
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->status==1?'正常':'待审核'}}</td>
            <td><a href="{{route('shops.edit',[$shop])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('shops.destroy',[$shop])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $shops->links() }}
    @stop