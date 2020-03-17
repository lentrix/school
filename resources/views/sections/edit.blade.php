@extends('main')

@section('content')

<h1>Edit Section</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/sections')}}">Sections</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Section</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-5">
        {!! Form::model($section, ['url'=>"/sections/$section->id", 'method'=>'patch']) !!}

        @include("sections._form")

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-save"></i> Update Section
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
