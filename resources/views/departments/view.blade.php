@extends('main')

@section('content')

<h1>View Department</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/departments')}}">Departments</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Department</li>
    </ol>
</nav>

<div class="row row-eq-height">
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>
                    Department Details
                    <a href='{{url("/departments/$department->id/edit")}}' class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>

            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th class="table-info">Accronym</th><td>{{$department->accronym}}</td></tr>
                    <tr><th class="table-info">Name</th><td>{{$department->name}}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>Department Personnel</h3>
            </div>
            <div class="card-body">

                <ul class="list-group">
                    @foreach($users as $user)

                    <li class="list-group-item">
                        {{$user->fullName}}
                        <a href='{{url("/users/$user->id")}}' class="btn btn-secondary btn-sm float-right">
                            <i class="fa fa-door-open"></i>
                        </a>
                    </li>

                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@stop
