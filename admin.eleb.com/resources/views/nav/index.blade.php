@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>路由</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
        <tr>
            <td>{{$nav->id}}</td>
            <td>{{$nav->name}}</td>
            <td>{{$nav->url}}</td>
            <td>@can('navs.edit')
                <a href="{{route('navs.edit',[$nav])}}">编辑</a>
                @endcan
                @can('navs.destory')
                <form method="post" style="display: inline" action="{{route('navs.destroy',[$nav])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
                    @endcan
            </td>
        </tr>
            @endforeach
    </table>
    {{ $navs->links() }}
    @stop