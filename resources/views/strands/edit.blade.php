@extends('main')

@section('content')

<h1>Update Strand</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/strands')}}">Strands</a></li>
        <li class="breadcrumb-item"><a href='{{url("/strands/$strand->id")}}'>{{$strand->identityString}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Strand</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-5">
        {{Form::model($strand,['url'=>'/strands', 'method'=>'post'])}}

        @include('strands._form')

        <div class="form-group">
            <button class="btn btn-primary float-right" type="submit">
                <i class="fa fa-save"></i> Update Strand
            </button>
        </div>

        {{Form::close()}}
    </div>
</div>
@stop
