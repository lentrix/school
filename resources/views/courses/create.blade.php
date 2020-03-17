@extends('main')

@section('content')

<h1>Create Course</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/courses')}}">Courses</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Course</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">
        {{Form::open(['url'=>"/courses", 'method'=>'post'])}}

        @include("courses._form")

        <div class="form-group">
            <button class="btn btn-primary float-right">
                <i class="fa fa-save"></i> Create Course
            </button>
        </div>

        {{Form::close()}}
    </div>
</div>
@stop
