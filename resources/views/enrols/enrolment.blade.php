@extends('main')

@section('content')

<h1>Enrolment: {{$student->fullName}}</h1>

<div class="row">
    <div class="col-md-6">

        {!! Form::open(['url'=>'/enrols', 'method'=>'post']) !!}
            {{Form::hidden('student_id', $student->id)}}

        <div class="form-group">
            <?= Form::label('period_id', 'School Period'); ?>
            <?= Form::select('period_id', \App\Period::listEnrolment(),
                null,['class'=>'form-control','placeholder'=>'Select a period']); ?>
        </div>

        <div class="form-group">
            {{Form::label('program_id','Program')}}
            {{Form::select('program_id', \App\Program::pluck('name','id'),
                    null,
                    ['class'=>'form-control', 'placeholder'=>'Select program'])}}
        </div>

        <div class="form-group">
            <?= Form::label('level_id', 'Level'); ?>
            <?= Form::select('level_id',
                \App\Level::pluck('name','id'),
                null,['class'=>'form-control', 'placeholder'=>'Select a level']); ?>
        </div>

        <div class="form-group">
            {{Form::label('strand_id','Strand')}}
            {{Form::select('strand_id', \App\Strand::list(),
                    null,
                    ['class'=>'form-control', 'placeholder'=>'Select program'])}}
        </div>

        <div class="form-group">
            {{Form::label('section_id','Section')}}
            {{Form::select('section_id', \App\Section::list(),
                    null,
                    ['class'=>'form-control', 'placeholder'=>'Select program'])}}
        </div>

        <div class="form-group">
            <input type="radio" name="type" value="old" id="old">
            <label for="old">Old Student</label> &nbsp;&nbsp;
            <input type="radio" name="type" value="new" id="new">
            <label for="new">New Student</label> &nbsp;&nbsp;
            <input type="radio" name="type" value="transferee" id="transferee">
            <label for="transferee">Transferee</label> &nbsp;&nbsp;
        </div>

        <div class="form-group">
            <button class="btn btn-primary float-right">
                <i class="fa fa-check"></i> Enrol Student
            </button>
        </div>

        {!! Form::close() !!}

    </div>
</div>


@stop
