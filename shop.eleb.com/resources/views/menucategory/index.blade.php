@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>是否默认</th>
            <th>操作</th>
        </tr>
        @foreach($menu_categories as $menu_category)
        <tr>
            <td>{{$menu_category->id}}</td>
            <td>{{$menu_category->name}}</td>
            <td>{{$menu_category->type_accumulation}}</td>
            <td>{{$menu_category->shop_id}}</td>
            <td>{{$menu_category->is_selected==1?'是':'不是'}}</td>
            <td><a href="{{route('menu_categories.edit',[$menu_category])}}">编辑</a>
                <form method="post" style="display: inline" action="{{route('menu_categories.destroy',[$menu_category])}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="submit" class="btn btn-link">删除</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    {{ $menu_categories->links() }}
    @stop