@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>@can('roles.edit')
                <a href="{{route('roles.edit',[$role])}}">编辑</a>
                @endcan
                @can('roles.destory')
                <form method="post" style="display: inline" action="{{route('roles.destroy',[$role])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
                    @endcan
            </td>
        </tr>
            @endforeach
    </table>
    {{ $roles->links() }}
    @stop