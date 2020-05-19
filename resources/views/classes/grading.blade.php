@extends('main')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
      <li class="breadcrumb-item active" aria-current="page">Class Grading</li>
    </ol>
</nav>

<h1>Class Grading</h1>

<div style="font-size: 1.2em; font-weight: bold; border: 1px solid #aaa; padding: 5px; margin-bottom: 10px;">
    {{$class->course->description}} | {{$class->scheduleText}}
</div>

@stop
