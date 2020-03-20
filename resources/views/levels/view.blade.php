@extends('main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/levels')}}">Levels</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$level->name}}</li>
    </ol>
</nav>

<h1>Level: {{$level->code}}</h1>

@if(count($enrols)>0)

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-primary text-white">
            <th>#</th>
            <th>Name</th>
            <th><i class="fa fa-door-open"></i></th>
        </tr>
    </thead>
</table>

@else

<p>No student.</p>

@endif

@stop
