@extends('main')

@section('content')

@include('classes._sched-form')

@include('classes._remove-sched')

<h1>View Class</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/classes')}}">Class Offerings</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Class</li>
    </ol>
</nav>

<div class="row">

    <div class="col-md-6">
        <a href='{{url("/classes/$class->id/edit")}}' class="btn btn-secondary float-right">
            <i class="fa fa-edit"></i> Edit
        </a>
        <h3>Class Details</h3>
        <table class="table table-bordered table-striped">
            <tr>
                <th class="bg-primary text-white">Class Code</th>
                <td>{{str_pad($class->id, 10,'0', STR_PAD_LEFT)}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Course Code</th>
                <td>{{$class->course->code}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Description</th>
                <td>{{$class->course->description}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Teacher</th>
                <td>{{$class->user->fullName}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Section</th>
                <td>{{$class->section ? $class->section->name : "-"}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Program</th>
                <td>{{$class->program ? $class->program->name : "-"}}</td>
            </tr>
            <tr>
                <th class="bg-primary text-white">Department</th>
                <td>{{$class->department ? $class->department->name : "-"}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <button class="btn btn-secondary float-right" title="Add a schedule"
                data-toggle="modal" data-target="#schedFormModal">
            <i class="fa fa-plus"></i> Add
        </button>
        <h3>Schedule</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-primary text-white">
                    <th>Time</th>
                    <th>Days</th>
                    <th>Venue</th>
                    <th style="text-align: right">...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($class->schedules as $sched)

                <tr>
                    <td>{{$sched->start}} - {{$sched->end}}</td>
                    <td>{{$sched->days}}</td>
                    <td>{{$sched->room->name}}</td>
                    <td style="text-align: right">
                        <button class="btn btn-danger btn-sm removeSched"
                                type="button" data-toggle="modal"
                                data-target="#removeSchedModal"
                                data-time="{{$sched->start}}-{{$sched->end}}"
                                data-days="{{$sched->days}}"
                                data-venue="{{$sched->room->name}}"
                                data-id="{{$sched->id}}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<hr>

<h2>Students List</h2>

<table class="table table-bordered table-striped table-sm">
    <thead>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>#</th>
    </thead>
    <tbody>
        @foreach($class->enrolClasses() as $enc)

        <tr>
            <td>{{$enc->enrol->student->lname}}</td>
            <td>{{$enc->enrol->student->fname}}</td>
            <td>{{$enc->enrol->student->mname}}</td>
            <td>
                <a href='{{url("/students/{$enc->enrol->student_id}")}}' class="btn btn-info btn-sm" title="Student Information">
                    <i class="fa fa-info"></i>
                </a>
                <a href='{{url("/enrols/{$enc->enrol->id}/show")}}' class="btn btn-primary btn-sm" title="Enrolment File">
                    <i class="fa fa-file"></i>
                </a>
            </td>
        </tr>

        @endforeach;
    </tbody>
</table>
@stop


@section('scripts')

<script>
    $(document).ready(function(){
        $(".removeSched").click(function(){
            var id = $(this).attr('data-id');
            var time = $(this).attr('data-time');
            var days = $(this).attr('data-days');
            var venue = $(this).attr('data-venue');

            $("#sched_id").val(id);
            $("#time").text(time);
            $("#xdays").text(days);
            $("#venue").text(venue);
            $("#idshow").text(id);
        })
    })
</script>

@stop
