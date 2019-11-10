@extends('main')

@section('content')

<br>
<h1>Create a Period</h1>

<div class="row">

    <div class="col-md-6">
        {!! Form::open(['url'=>"/periods", 'method'=>'post']) !!}

        @include('periods._form')

        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fa fa-plus"></i> Create Period
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
