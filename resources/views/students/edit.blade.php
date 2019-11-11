@extends('main')

@section('content')

<h1>Edit Student</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/students')}}">Students</a></li>
        <li class="breadcrumb-item"><a href="{{url("/students/$student->id")}}">{{$student->fullName}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
    </ol>
</nav>

{!! Form::model($student, ['url'=>"/students/$student->id", 'method'=>'patch']) !!}

@include('students._form')

<div class="form-group">
    <button class="btn btn-primary float-right" type="submit">
        <i class="fa fa-save"></i> Update Student
    </button>
</div>

{!!Form::close() !!}
@stop
