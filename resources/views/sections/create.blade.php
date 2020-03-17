@extends('main')

@section('content')

<h1>Create Section</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/sections')}}">Sections</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Section</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-5">
        {!! Form::open(['url'=>'/sections', 'method'=>'post']) !!}

        @include('sections._form')

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-plus"></i> Create Section
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
