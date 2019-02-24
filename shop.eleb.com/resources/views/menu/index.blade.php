@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>菜品名</th>
            <th>价格</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->shop_id}}</td>
            <td>{{$menu->category_id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->goods_price}}</td>
            <td><img src="{{$menu->goods_img}}"style="width: 50px" ></td>
            <td>{{$menu->status==1?'上架':'下架'}}</td>
            <td><a href="{{route('menus.edit',[$menu])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('menus.destroy',[$menu])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $menus->appends(['keyword'=>$keyword,'price1'=>$price1,'price2'=>$price2])->links() }}
    @stop