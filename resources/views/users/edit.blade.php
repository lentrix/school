@extends('main')


@section('content')

<h1>Edit User</h1>

{!! Form::model($user, ['url'=>"/users/$user->id", 'method'=>'patch']) !!}

@include('users._form',['create'=>false])

<div class="form-group">
    <button class="btn btn-primary float-right" type="submit">
        <i class="fa fa-save"></i> Update User Profile
    </button>
</div>

{!! Form::close() !!}

@stop
