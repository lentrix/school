@extends('main')

@section('content')

<h1>
    Programs
    <a href="{{url('/programs/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Create Program
    </a>
    <div class="float-right">
        <form action="{{url('/programs/search')}}" style="display:inline-block">
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
    <p style="color: #229">Search results for "{{$_GET['search']}}"</p>
@endif

<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Accronym</th>
            <th>Name</th>
            <th>Category</th>
            <th>Department</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($programs as $program)

        <tr>
            <td>{{$program->accronym}}</td>
            <td>{{$program->name}}</td>
            <td>{{$program->category}}</td>
            <td>{{$program->department->accronym}}</td>
            <td>
                <a href='{{url("/programs/$program->id")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
