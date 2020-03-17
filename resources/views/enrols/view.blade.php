@extends('main')

@section('content')

<h1>View Enrolment</h1>

<div class="card card-primary">
    <div class="card-header">
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
        <h4>Class Schedule</h4>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Course No.</th>
                    <th>Description</th>
                    <th>Units</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@stop
