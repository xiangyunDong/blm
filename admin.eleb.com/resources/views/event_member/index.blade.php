@extends('layout.app')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>活动id</th>
            <th>账号id</th>
        </tr>
        @foreach($event_members as $event_member)
        <tr>
            <td>{{$event_member->id}}</td>
            <td>{{$event_member->events_id}}</td>
           <td>{{$event_member->member_id}}</td>
        </tr>
            @endforeach
    </table>
    {{$event_members->links()}}
    @stop