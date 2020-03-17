@extends('main')

@section('content')
<h1>
    Users
    <a href="{{url('/users/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New User
    </a>

    <div class="float-right">
        <form action="{{url('/users/search')}}" style="display:inline-block" method="get">
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

<table class="table table-bordered">
    <thead>
        <tr>
            <th>User Name</th>
            <th>Full Name</th>
            <th>Department</th>
            <th>Active</th>
            <th>
                &nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)

        <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->fullName}}</td>
            <td>{{$user->department->name}}</td>
            <td>
                @if($user->active)
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>
                <a href='{{url("/users/$user->id")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
