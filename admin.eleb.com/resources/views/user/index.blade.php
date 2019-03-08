@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->shop_id}}</td>
            <td>{{$user->status==1?'启用':'禁用'}}</td>
            <td>@can('users.edit')
                <a href="{{route('users.edit',[$user])}}">编辑</a>
                @endcan
                @can('users.reset')
                <form method="post" style="display: inline" action="{{route('users.reset',[$user])}}">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <button type="submit" class="btn btn-link">重置密码</button>
                </form>
                @endcan
                @can('users.destory')
                <form method="post" style="display: inline" action="{{route('users.destroy',[$user])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
                    @endcan
            </td>
        </tr>
            @endforeach
    </table>
    {{ $users->links() }}
    @stop