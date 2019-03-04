@extends('layout.app')
@section('contents')
    <table class="table table-bdetaled">
        <tr>
            <th>订单id</th>
            <th>菜品名字</th>
            <th>菜品图片</th>
            <th>菜品价格</th>
            <th>菜品数量</th>
        </tr>
        @foreach($details as $detal)
        <tr>
            <td>{{$detal->order_id}}</td>
           <td>{{$detal->goods_name}}</td>
            <td><img src="{{$detal->goods_img}}" width="50"></td>
            <td>{{$detal->goods_price}}</td>
            <td>{{$detal->amount}}</td>
        </tr>
            @endforeach
    </table>
    @stop