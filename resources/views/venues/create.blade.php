@extends('main')

@section('content')
<h1>Create Venue</h1>

<div class="row">
    <div class="col-md-5">

        {!! Form::open(['url'=>"/venues",'method'=>'post']) !!}

        @include('venues._form')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-check"></i> Create Venue
            </button>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@stop
