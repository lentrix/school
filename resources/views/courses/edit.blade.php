@extends('main')

@section('content')

<h1>Edit Course</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/courses')}}">Courses</a></li>
        <li class="breadcrumb-item"><a href="{{url('/courses/'.$course->id)}}">{{$course->code}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">
        {{Form::model($course,['url'=>"/courses/$course->id", 'method'=>'patch'])}}

        @include("courses._form")

        <div class="form-group">
            <button class="btn btn-primary float-right">
                <i class="fa fa-save"></i> Update Course
            </button>
        </div>

        {{Form::close()}}
    </div>
</div>
@stop
