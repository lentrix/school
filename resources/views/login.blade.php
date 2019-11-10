@extends('main')

@section('content')

<div class="row" style="margin-top: 50px">
    <div class="col-md-6 col-sm-8 offset-md-3 offset-lg-2">
        <div class="card card-primary">

            <div class="card-header">
                <h1>User Login</h1>
            </div>

            <div class="card-body">

                {{Form::open(['url'=>'/login', 'method'=>'post'])}}

                <div class="form-group">
                    {{Form::label('username')}}
                    {{Form::text('username',null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password')}}
                    {{Form::password('password',['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary float-right">
                        <i class="fa fa-check"></i> Login
                    </button>
                </div>

                {{Form::close()}}

            </div>

        </div>
    </div>
</div>

@stop
