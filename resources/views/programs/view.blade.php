@extends('main')

@section('content')

<h1>View Program</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/programs')}}">Programs</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Program</li>
    </ol>
</nav>

<div class="row">
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>
                    Program Details
                    <a href='{{url("/programs/$program->id/edit")}}' class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th class="table-info">Accronym</th>
                        <td>{{$program->accronym}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Name</th>
                        <td>{{$program->name}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Category</th>
                        <td>{{$program->category}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Department</th>
                        <td>{{$program->department->name}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>
                    Student List
                </h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@stop
