@extends('main')

@section('content')

<h1>Teaching Load</h1>

<p>
    <strong>Name: </strong> {{$user->fullName}} <br>
    <strong>Department:</strong> {{$user->department->name}}
</p>

<hr>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-secondary text-dark">
            <th>Schedule</th>
            <th>Code</th>
            <th>Description</th>
            <th>Units</th>
            <th>...</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)
        <tr>
            <td>{!!$class->getScheduleTextAttribute(true)!!}</td>
            <td>{{$class->course->code}}</td>
            <td>{{$class->course->description}}</td>
            <td>{{$class->credit_units}}</td>
            <td>
                <a href='{{url("/classes/$class->id/view")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
                <a href='{{url("/classes/$class->id/attn")}}/{{date('m')*1}}' class="btn btn-primary btn-sm" title="Class Attendance">
                    <i class="fa fa-tasks"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
