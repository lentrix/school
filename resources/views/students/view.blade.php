@extends('main')

@section('content')

<h1>View Student</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/students')}}">Students</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Student</li>
    </ol>
</nav>

<div class="row row-eq-height">

    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>
                    Student Details
                    <a href="{{url('/students/'.$student->id.'/edit')}}" class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-sm">
                    <tr><th>ID Number</th><td>{{$student->id}}</td></tr>
                    <tr><th>Last Name</th><td>{{$student->lname}}</td></tr>
                    <tr><th>First Name</th><td>{{$student->fname}}</td></tr>
                    <tr><th>Middle Name</th><td>{{$student->mname}}</td></tr>
                    <tr><th>Birth Date</th><td>{{$student->bdate->format('M d, Y')}}</td></tr>
                    <tr><th>Gender</th><td>{{$student->gender}}</td></tr>
                    <tr><th>Address</th><td>{{$student->fullAddress}}</td></tr>
                    <tr><th>Phone</th><td>{{$student->phone}}</td></tr>
                    <tr><th>Religion</th><td>{{$student->religion}}</td></tr>
                    <tr><th>Mother</th><td>{{$student->mother}}</td></tr>
                    <tr><th>Mother's Phone</th><td>{{$student->mphone}}</td></tr>
                    <tr><th>Father</th><td>{{$student->father}}</td></tr>
                    <tr><th>Father's Phone</th><td>{{$student->fphone}}</td></tr>
                    <tr><th>Parent's address</th><td>{{$student->pr_address}}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>Enrolment History</h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@stop
