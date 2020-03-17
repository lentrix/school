@extends('main')

@section('content')

<h1>Create User</h1>


{!! Form::open(['url'=>'/users', 'method'=>'post']) !!}

@include('users._form',['create'=>true])

<div class="form-group">
    <button class="btn btn-primary float-right" type="submit">
        <i class="fa fa-save"></i> Create User
    </button>
</div>

{!! Form::close() !!}


@stop
