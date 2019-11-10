@extends('main')

@section('content')
<br>
<h1>
    School Periods
    <a href="{{url('/periods/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Create Period
    </a>
    <div class="float-right">
        <form action="{{url('/periods/search')}}" style="display:inline-block">
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
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Accronym</th>
            <th>Semester</th>
            <th>Start</th>
            <th>End</th>
            <th>Status</th>
            <th>
                <i class="fa fa-bullseye"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($periods as $period)
        <tr>
            <td>{{$period->accronym}}</td>
            <td>{{$period->name}}</td>
            <td>{{$period->start->format('M d, Y')}}</td>
            <td>{{$period->end->format('M d, Y')}}</td>
            <td>{{$period->status}}</td>
            <td>
                <a href="{{url('/periods/'.$period->id)}}" class="btn btn-sm btn-secondary">
                    <i class="fa fa-door-open" title="Open Period"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
