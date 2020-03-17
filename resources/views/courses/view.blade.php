@extends('main')

@section('content')

<h1>
    View Course
</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/courses')}}">Courses</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Course</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3>
                    Course Details
                    <a href='{{url("/courses/$course->id/edit")}}' class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th class="table-info">Course Code</th>
                        <td>{{$course->code}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Description</th>
                        <td>{{$course->description}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Units</th>
                        <td>{{$course->units}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Academic</th>
                        <td>
                            @if($course->academic)
                                <i class="fa fa-check"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="table-info">Program</th>
                        <td>{{$course->program?$course->program->accronym:"..."}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Class Offerings</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="table-info">
                            <th>Teacher</th>
                            <th>Pay Units</th>
                            <th>Schedule</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    @foreach($classes as $cls)

                    <tr>
                        <td>{{$cls->user->fullName}}</td>
                        <td>{{$cls->pay_units}}</td>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <a href='{{url("/classes/$cls->id")}}' class="btn btn-secondary btn-sm">
                                <i class="fa fa-door-open"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@stop
