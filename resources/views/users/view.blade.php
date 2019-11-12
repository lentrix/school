@extends('main')

@section('content')

<h1>User Profile</h1>

<div class="row">
    <div class="col-md-3">
        <img src="{{asset('images/avatars/unknown-512.png')}}"
            alt="Profile Picture" width="90%">
    </div>
    <div class="col-md-6">
        <table class="table bordered table-sm">
            <tr>
                <th class="table-info">User Name:</th> <td>{{$user->username}}</td>
            </tr>
            <tr>
                <th class="table-info">Last Name:</th> <td>{{$user->lname}}</td>
            </tr>
            <tr>
                <th class="table-info">First Name:</th> <td>{{$user->fname}}</td>
            </tr>
            <tr>
                <th class="table-info">Middle Name:</th> <td>{{$user->mname}}</td>
            </tr>
            <tr>
                <th class="table-info">Address:</th> <td>{{$user->address}}</td>
            </tr>
            <tr>
                <th class="table-info">Phone:</th> <td>{{$user->phone}}</td>
            </tr>
            <tr>
                <th class="table-info">Field:</th> <td>{{$user->field}}</td>
            </tr>
        </table>
    </div>
    <div class="col">
        <a href='{{url("/users/$user->id/edit")}}' class="btn btn-secondary btn-block">
            <i class="fa fa-edit"></i> Edit Profile
        </a>

        <a href='{{url("/users/$user->id/change-password")}}' class="btn btn-secondary btn-block">
            <i class="fa fa-user-lock"></i> Change Password
        </a>

        @if(auth()->user()->hasRole('admin'))
        <a href='{{url("/users/$user->id/deactivate")}}' class="btn btn-secondary btn-block">
            <i class="fa fa-ban"></i> Deactivate Account
        </a>
        @endif

    </div>
</div>

@stop
