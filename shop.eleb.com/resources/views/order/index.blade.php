@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>订单编号</th>
            <th>订单价格</th>
            <th>订单状态</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->sn}}</td>
           <td>{{$order->total}}</td>
            <td>
                @if($order->status==-1)
                    已取消
                @elseif($order->status==0)
                    待支付
                @elseif($order->status==1)
                    待发货
                @elseif($order->status==2)
                    待确认
                    @endif
            </td>
            <td><a href="{{route('orders.show',[$order])}}">查看详情</a>
                <form method="post" style="display: inline" action="{{route('orders.send',[$order])}}">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    @if($order->status==-1)
                    <button type="submit" class="btn btn-link" disabled="disabled">订单已取消</button>
                    @elseif($order->status==0)
                    <button type="submit" class="btn btn-link">发货</button>
                    @elseif($order->status==1)
                        <button type="submit" class="btn btn-link">发货</button>
                    @elseif($order->status==2)
                        <button type="submit" class="btn btn-link" disabled="disabled">已发货</button>
                        @endif()
                </form>
                <form method="post" style="display: inline" action="{{route('orders.cancel',[$order])}}">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    @if($order->status==-1)
                    <button type="submit" class="btn btn-link" disabled="disabled">取消订单</button>
                    @elseif($order->status==0)
                        <button type="submit" class="btn btn-link">取消订单</button>
                    @elseif($order->status==1)
                        <button type="submit" class="btn btn-link" >取消订单</button>
                    @endif()
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $orders->links() }}
    @stop