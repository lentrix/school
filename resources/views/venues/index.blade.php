@extends('main')

@section('content')

<h1>
    Venues
    <a href="{{url('/venues/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Venue
    </a>
</h1>

<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr class="bg-primary text-white">
            <th>Code</th>
            <th>Name</th>
            <th>Building</th>
            <th>Floor</th>
            <th>Capacity</th>
            <th class="right">
                <i class="fa fa-door-open"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)

        <tr>
            <td>{{$room->code}}</td>
            <td>{{$room->name}}</td>
            <td>{{$room->building}}</td>
            <td>{{$room->floor}}</td>
            <td>{{$room->capacity}}</td>
            <td class="right">
                <a href='{{url("/venues/$room->id")}}'>
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
