@extends('main')

@section('content')

<h1>Edit Department</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/departments')}}">Departments</a></li>
        <li class="breadcrumb-item"><a href="{{url('/departments/'.$department->id)}}">{{$department->accronym}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Department</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-5">
        {!!Form::model($department, ['url'=>"/departments/$department->id", 'method'=>'patch']) !!}

        @include('departments._form')

        <div class="form-group">
            <button class="btn btn-primary float-right" type="submit">
                <i class="fa fa-save"></i> Update Department
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@stop
