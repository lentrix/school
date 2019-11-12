@extends('main')

@section('content')

<h1>Change Password: {{$user->username}}</h1>

<div class="row">
    <div class="col-md-5">
        {!! Form::open(['url'=>"/users/$user->id/change-password", 'method'=>'post']) !!}

        @if(!auth()->user()->hasRole('admin'))
        <div class="form-group">
            {{Form::label('current_password')}}
            {{Form::password('current_password',['class'=>'form-control'])}}
        </div>
        @endif

        <div class="form-group">
            {{Form::label('new_password')}}
            {{Form::password('new_password',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('new_password_confirmation')}}
            {{Form::password('new_password_confirmation',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary float-right">
                <i class="fa fa-lock"></i> Change Password
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
