@extends('main')

@section('content')
<br>
<h1>Edit Period</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/periods')}}">Periods</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">

        {!! Form::model($period,['url'=>"/periods/$period->id", 'method'=>'patch']) !!}

        @include('periods._form')

        <div class="form-group">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Update Period</button>
        </div>

        {!! Form::close() !!}

    </div>
    <div class="col-md-6">
        <h3>Current Status: {{$period->status}}</h3>
        {!! Form::open(['url'=>"/periods/$period->id/change-status", 'method'=>'post']) !!}

        <div class="input-group">
            <div class="input-group-prepend">{{Form::label('status',null,['class'=>'input-group-text'])}}</div>
            {{Form::select('status',[
                    'pending'=>"Pending",
                    'enrol'=>'Enrolment',
                    'q1' => 'First Quarter',
                    'q2' => 'Second Quarter',
                    'q3' => 'Third Quarter',
                    'q4' => 'Fourth Quarter',
                    'mid' => 'Midterm',
                    'fin' => 'Final',
                    'close' => 'Closed'
            ],null,['class'=>'form-control','placeholder'=>'Select Status'])}}

            <div class="input-group-append">
                <button class="btn btn-primary">
                    Change Status
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
