@extends('main')

@section('content')

<h1>Edit Class</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/classes')}}">Class Offerings</a></li>
        <li class="breadcrumb-item"><a href='{{url("/classes/$class->id/view")}}'>{{$class->course->code}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Class</li>
    </ol>
</nav>

{!! Form::model($class, ['url'=>"/classes/$class->id", 'method'=>'patch']) !!}

@include('classes._form')

<div class="form-group">
    <button class="btn btn-primary" type="submit">
        Update Class
    </button>
</div>

{!! Form::close() !!}

@stop
