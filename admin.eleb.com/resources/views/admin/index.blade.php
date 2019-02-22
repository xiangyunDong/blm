@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td><a href="{{route('admins.edit',[$admin])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('admins.destroy',[$admin])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $admins->links() }}
    @stop