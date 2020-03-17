@extends('main')

@section('content')

<h1>
    Students
    <a href="{{url('/students/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Student
    </a>
    <div class="float-right">
        <form action="{{url('/students/search')}}" style="display:inline-block" method="get">
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

<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <th>ID Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>
                <i class="fa fa-door-open"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)

        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->lname}}</td>
            <td>{{$student->fname}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->bdate->diff(\Carbon\Carbon::now())->format("%y")}}</td>
            <td>
                <a href="{{url('/students/'.$student->id)}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
