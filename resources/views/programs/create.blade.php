@extends('main')

@section('content')

<h1>Create a Program</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/programs')}}">Programs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Program</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">
        {!!Form::open(['url'=>'/programs', 'method'=>'post']) !!}

        @include('programs._form')

        <div class="form-group">
            <button class="btn btn-primary float-right" type="submit">
                <i class="fa fa-save"></i> Create Program
            </button>
        </div>

        {!!Form::close()!!}
    </div>
</div>

@stop
