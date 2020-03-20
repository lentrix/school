@extends('main')

@section('content')

<h1>Edit Venue | {{$room->name}}</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/venues')}}">Venues</a></li>
        <li class="breadcrumb-item"><a href='{{url("/venues/$room->id")}}'>{{$room->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6">
        {!! Form::model($room, ['url'=>"/venues/$room->id",'method'=>'patch']) !!}

        @include('venues._form')

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Update Venue</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop
