@extends('main')

@section('content')

<h1>Create Department</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/departments')}}">Departments</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Department</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-5">
        {!! Form::open(['url'=>'/departments', 'method'=>'post']) !!}

        @include('departments._form')

        <div class="form-group">
            <button class="btn btn-primary float-left" type="submit">
                <i class="fa fa-save"></i> Create Department
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop
