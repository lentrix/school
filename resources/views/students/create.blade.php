@extends('main')

@section('content')

<h1>Create Student</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/students')}}">Students</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Student</li>
    </ol>
</nav>

{!! Form::open(['url'=>'/students', 'method'=>'post']) !!}

@include('students._form')

<div class="form-group">
    <button class="btn btn-primary float-right">
        <i class="fa fa-save"></i> Create Student
    </button>
</div>

{!! Form::close() !!}

@stop
