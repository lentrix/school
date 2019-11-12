@extends('main')

@section('content')

<h1>
    Courses
    <a href="{{url('/courses/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Course
    </a>
    <div class="float-right">
        <form action="{{url('/courses/search')}}" style="display:inline-block" method="get">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search" style="width: 300px">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-secondary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</h1>

@if(isset($_GET['search']))
<p>Search results for "{{$_GET['search']}}"</p>
@endif

<table class="table table-bordered">
    <thead>
        <tr class="table-info">
            <th>Code</th>
            <th>Description</th>
            <th>Units</th>
            <th>Academic</th>
            <th>Program</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)

        <tr>
            <td>{{$course->code}}</td>
            <td>{{$course->description}}</td>
            <td>{{$course->units}}</td>
            <td>
                @if($course->academic)
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>{{$course->program ? $course->program->accronym : "..."}}</td>
            <td>
                <a href='{{url("/courses/$course->id")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
