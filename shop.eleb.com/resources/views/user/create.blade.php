@extends('layout.app')
@section('contents')
    <h1>商家注册页面</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('users.store')}}" >
        <label>名称</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <label>邮箱</label>
        <input class="form-control" type="text" name="email" value="{{old('email')}}">
        <label>密码</label>
        <input class="form-control" type="password" name="password" value="{{old('password')}}">
        <label>所属商家</label>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
            <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                @endforeach
        </select>
        <label>状态</label>
        <div class="form-control">
            <input  type="radio" name="status" value="1">启用
            <input  type="radio" name="status" value="0">禁用
        </div>
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">提交</button>
    </form>
    @stop;