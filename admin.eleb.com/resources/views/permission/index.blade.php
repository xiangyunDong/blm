@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
        <tr>
            <td>{{$permission->id}}</td>
            <td>{{$permission->name}}</td>
            <td><a href="{{route('permissions.edit',[$permission])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('permissions.destroy',[$permission])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $permissions->links() }}
    @stop