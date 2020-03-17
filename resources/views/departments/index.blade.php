@extends('main')

@section('content')

<h1>
    Departments
    <a href="{{url('/departments/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Department
    </a>
    <div class="float-right">
        <form action="{{url('/departments/search')}}" style="display:inline-block" method="get">
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

<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="table-info">
                    <th>Accronym</th>
                    <th>Name</th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($depts as $dept)

                <tr>
                    <td>{{$dept->accronym}}</td>
                    <td>{{$dept->name}}</td>
                    <td>
                        <a href='{{url("/departments/$dept->id")}}' class="btn btn-primary btn-sm">
                            <i class="fa fa-door-open"></i>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
