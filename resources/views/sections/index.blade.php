@extends('main')

@section('content')

<h1>
    Sections
    <a href="{{url('/sections/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Section
    </a>
    <div class="float-right">
        <form action="{{url('/sections/search')}}" style="display:inline-block" method="get">
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
<p>Search result for "{{$_GET['search']}}"</p>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Program</th>
            <th>Level</th>
            <th>Room</th>
            <th>Adviser</th>
            <th>
                <i class="fa fa-door-open"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($sections as $section)

        <tr>
            <td>{{$section->name}}</td>
            <td>{{$section->program->accronym}}</td>
            <td>{{$section->level->name}}</td>
            <td>{{$section->room->name}}</td>
            <td>{{$section->user->fullName}}</td>
            <td>
                <a href='{{url("/sections/$section->id")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@stop
