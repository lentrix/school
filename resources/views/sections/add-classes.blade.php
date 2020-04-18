@extends('main')

@section('content')

<h1>Add Classes to {{$section->name}}</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/sections')}}">Sections</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href='{{url("/sections/$section->id")}}'>{{$section->name}}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Add Classes</li>
    </ol>
</nav>

<div style="position: relative">

{!! Form::open(['url'=>"/sections/$section->id/add-classes",'method'=>'post']) !!}

<table class="table table-bordered table-condensed">
    <thead class="bg-primary text-white">
        <tr>
            <th><i class="fa fa-check"></i></th>
            <th>Class Code</th>
            <th>Course Code</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Teacher</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)
        <tr>
            <td>
                <input class="selection" type="checkbox" name="class_id[]" value="{{$class->id}}">
            </td>
            <td>{{str_pad($class->id,10,'0', STR_PAD_LEFT)}}</td>
            <td>{{$class->course->code}}</td>
            <td>{{$class->course->description}}</td>
            <td>{{$class->scheduleText}}</td>
            <td>{{$class->user->fullName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<button class="btn btn-primary btn-lg submit-btn"
        style="position: fixed; bottom: 100px; right: 10px;opacity:0.75">
    <i class="fa fa-plus"></i> Add Classes
</button>

{!! Form::close() !!}

</div>
@stop

@section('scripts')

<script>
    $(document).ready(function(){
        $('.submit-btn').hover(function(){
            $(this).css('opacity',1.0)
        })
        $('.submit-btn').mouseleave(function(){
            $(this).css('opacity', 0.75)
        })

        $('.selection').change(function(){
            var background;

            if($(this).prop('checked')) {
                background = 'lightgray';
            }else {
                background = 'inherit';
            }

            $(this).parent().parent().css('backgroundColor', background)
        })
    })
</script>

@stop
