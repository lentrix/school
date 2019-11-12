@extends('main')

@section('content')

<h1>View Strand</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/strands')}}">Strands</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Strand</li>
    </ol>
</nav>

<div class="row">
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>
                    Strand Details
                    <a href='{{url("/strands/$strand->id/edit")}}' class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th class="table-info">Track</th>
                        <td>{{$strand->track}}</td>
                    </tr>
                    <tr>
                        <th class="table-info">Strand</th>
                        <td>{{$strand->strand}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Student List</h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@stop
