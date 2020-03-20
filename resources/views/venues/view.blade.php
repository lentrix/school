@extends('main')

@section('content')

<h1>View Venue | {{$room->name}}</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/venues')}}">Venues</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$room->name}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4">
        <div class="float-right">
            <a href='{{url("/venues/$room->id/edit")}}' class="btn btn-primary" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            <button class="btn btn-danger" title="Deactivate" {{count($schedules)>0 ? 'disabled' : ''}}>
                <i class="fa fa-times"></i>
            </button>
        </div>

        <h2>Venue Details</h2>
        <table class="table table-bordered table-striped table-sm">
            <tr>
                <th class="bg-primary text-white">Code</th>
                <td>{{$room->code}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Name</th>
                <td>{{$room->name}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Building</th>
                <td>{{$room->building}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Floor</th>
                <td>{{$room->floor}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Capacity</th>
                <td>{{$room->capacity}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-8">
        <h2>Assigned Classes</h2>

        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr class="bg-primary text-white">
                    <th>Course</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Days</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $sched)

                <tr>
                    <td>{{$sched->class->course->code}}</td>
                    <td>{{$sched->class->course->description}}</td>
                    <td>{{$sched->start}} - {{$sched->end}}</td>
                    <td>{{$sched->days}}</td>
                    <td>{{$sched->class->user->fullName}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop
