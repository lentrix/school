@extends('main')


@section('content')
<h1>
    Class Offerings
    <a href="{{url('/classes/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Class Offering
    </a>
    <div class="float-right">
        <form action="{{url('/classes/search')}}" style="display:inline-block" method="get">
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
@else
<p>Most recently updated class offerings..</p>
@endif

<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr class="bg-primary text-white">
            <th>Serial</th>
            <th>Course</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Credit Units</th>
            <th>Teacher</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)

        <tr>
            <td>
                <a href='{{url("/classes/$class->id/view")}}' class="btn btn-primary btn-sm">
                    {{str_pad($class->id, 7, '0', STR_PAD_LEFT)}}
                </a>
            </td>
            <td>{{$class->course->code}}</td>
            <td>{{$class->course->description}}</td>
            <td>...</td>
            <td>{{$class->credit_units}}</td>
            <td>{{$class->user->fullName}}</td>
        </tr>

        @endforeach
    </tbody>
</table>
@stop
