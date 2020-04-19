@extends('main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/students')}}">Students</a></li>
        <li class="breadcrumb-item"><a href='{{url("/students/{$enrol->student->id}")}}'>{{$enrol->student->fullName}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Enrolment</li>
    </ol>
</nav>

<h1>Update Enrolment</h1>
<div class="col-md-6">
    {!! Form::model($enrol, ['url'=>"/enrols/$enrol->id", 'method'=>'put']) !!}

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
            <input type="radio" name="type" value="old" id="old" {{$enrol->type=="old"?"checked":""}}>
            <label for="old">Old Student</label> &nbsp;&nbsp;
            <input type="radio" name="type" value="new" id="new" {{$enrol->type=="new"?"checked":""}}>
            <label for="new">New Student</label> &nbsp;&nbsp;
            <input type="radio" name="type" value="transferee" id="transferee" {{$enrol->type=="transferee"?"checked":""}}>
            <label for="transferee">Transferee</label> &nbsp;&nbsp;
        </div>

        <div class="form-group">
            <button class="btn btn-primary float-right">
                <i class="fa fa-edit"></i> Update Enrolment
            </button>
        </div>

    {!! Form::close() !!}
</div>
@stop
