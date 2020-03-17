@extends('main')

@section('content')

<h1>Edit Program</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/programs')}}">Programs</a></li>
        <li class="breadcrumb-item"><a href="{{url('/programs/'.$program->id)}}">{{$program->accronym}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Program</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">
        {!!Form::model($program, ['url'=>'/programs', 'method'=>'post']) !!}

        @include('programs._form')

        <div class="form-group">
            <button class="btn btn-primary float-right" type="submit">
                <i class="fa fa-save"></i> Update Program
            </button>
        </div>

        {!!Form::close()!!}
    </div>
</div>

@stop
