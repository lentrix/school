@extends('main')

@section('content')

<h1>Create Class</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/classes')}}">Class Offerings</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Class</li>
    </ol>
</nav>


{!! Form::open(['url'=>'/classes', 'method'=>'post']) !!}

@include('classes._form')

<div class="form-group">
    <button class="btn btn-primary">Create Class</button>
</div>

{!! Form::close() !!}

@stop
