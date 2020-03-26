@extends('main')

@section('content')

@include("enrols._add-class")
@include("enrols._remove-class")

<h1>View Enrolment</h1>

<div class="card card-primary">
    <div class="card-header">
        <div class="float-right">
            @if($enrol->section)
                <button class="btn btn-danger"><i class="fa fa-times"></i> Section</button>
            @else
                <button class="btn btn-info"><i class="fa fa-plus"></i> Section</button>
            @endif
        </div>
        <h3>Enrolment Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Name:</strong> {{$enrol->student->fullName}}</td>
                    <td><strong>Period:</strong> {{$enrol->period->name}}</td>
                    <td>
                        <strong>Program & Level:</strong>
                        {{$enrol->program->accronym}}-{{$enrol->level->code}}
                        @if($enrol->strand)
                        ({{$enrol->strand->identityString()}})
                        @endif
                    </td>
                    @if($enrol->section)
                    <td>
                        <strong>Section:</strong>
                        {{$enrol->section->name}}
                    </td>
                    @endif
                </tr>
            </table>
        </div>
        <hr>
        <div class="float-right">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addClassModal">
                <i class="fa fa-plus"></i> Class
            </button>
            <button class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Withdraw
            </button>
        </div>
        <h4>Class Schedule</h4>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Course No.</th>
                    <th>Description</th>
                    <th>Units</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrol->enrolClasses as $enrolClass)
                <tr>
                    <td>{{str_pad($enrolClass->class->id,5,'0',false)}}</td>
                    <td>{{$enrolClass->class->course->code}}</td>
                    <td>{{$enrolClass->class->course->description}}</td>
                    <td>{{$enrolClass->class->credit_units}}</td>
                    <td>{!!$enrolClass->class->getScheduleTextAttribute(true)!!}</td>
                    <td>{{$enrolClass->class->user->fullName}}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-class"
                                data-toggle="modal"
                                data-target="#removeClassModal"
                                data-enrolId="{{$enrolClass->enrol_id}}"
                                data-classId="{{$enrolClass->class_id}}"
                                data-code="{{$enrolClass->class->course->code}}"
                                data-sched="{{$enrolClass->class->scheduleText}}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('scripts')

<script>
    $(document).ready(function(){
        $(".remove-class").click(function(){
            var enrolId = $(this).attr('data-enrolId');
            var classId = $(this).attr('data-classId');
            var code = $(this).attr('data-code');
            var sched = $(this).attr('data-sched');

            $("#item").text(code + " " + sched);
            $("#enrol_id").val(enrolId);
            $("#class_id").val(classId);
        })
    })
</script>

@stop
