@extends('layout.app')
@section('contents')
    <form class="navbar-form navbar-left" method="get" action="{{route('members.index')}}">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="请输入会员名或手机号" name="keyword">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->username}}</td>
            <td>{{$member->tel}}</td>
            <td>{{$member->status==1?'启用':'禁用'}}</td>
            <td><a href="{{route('members.show',[$member])}}">查看</a>
                <form method="post" style="display: inline" action="{{route('members.reset',[$member])}}">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    @if($member->status==1)
                    <button type="submit" class="btn btn-link">禁用</button>
                        @elseif($member->status==0)
                        <button type="submit" class="btn btn-link">启用</button>
                        @endif
                </form>
                <form method="post" style="display: inline" action="{{route('members.destroy',[$member])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $members->links() }}
    @stop