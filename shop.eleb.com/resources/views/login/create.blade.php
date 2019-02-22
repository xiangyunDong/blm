@extends('layout.app')
@section('contents')
    <h1>登录</h1>
    @include('layout._errors')
    <form class="form-group" method="post" action="{{route('login')}}">
        <label>账号</label>
        <input class="form-control" type="text" name="name">
        <label>密码</label>
        <input class="form-control" type="password" name="password">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="rememberMe" value="1"> Check me out
            </label>
        </div>
        <label>验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        {{csrf_field()}}
        <button class="btn bg-primary" type="submit">登录</button>
    </form>
    @stop