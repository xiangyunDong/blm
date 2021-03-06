@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shop_categories as $shop_category)
        <tr>
            <td>{{$shop_category->id}}</td>
            <td>{{$shop_category->name}}</td>
            <td><img src="{{$shop_category->img}}"style="width: 50px" ></td>
            <td>{{$shop_category->status==1?'显示':'隐藏'}}</td>

            <td>@can('shop_categories.edit')
                        <a href="{{route('shop_categories.edit',[$shop_category])}}">编辑</a>
                @endcan

                @can('shop_categories.del')
                <form method="post" style="display: inline" action="{{route('shop_categories.destroy',[$shop_category])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
                @endcan
            </td>
        </tr>
            @endforeach
    </table>
    {{ $shop_categories->links() }}
    @stop