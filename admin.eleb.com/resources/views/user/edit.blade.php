@extends('layout.app')
@section('contents')
    <h1>商家账号修改页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('users.update',[$user])}}">
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{$user->name}}">
        <label>邮箱</label>
        <input class="form-control" type="text" name="email" value="{{$user->email}}">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
                <option value="{{$shop->id}}"
                 @if($shop->id==$user->shop_id) selected @endif
                >{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1" @if($user->status==1)checked @endif>启用
            <input  type="radio" name="status" value="0" @if($user->status==0)checked @endif>禁用
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
@stop;