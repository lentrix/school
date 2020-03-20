@extends('main')

@section('content')

<h1>Levels</h1>

<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr class="bg-primary text-white">
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th style="text-align:right"><i class="fa fa-door-open"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($levels as $level)
            <tr>

                <td>{{$level->code}}</td>
                <td>{{$level->name}}</td>
                <td>{{$level->category}}</td>
                <td style="text-align:right">
                    <a href='{{url("/levels/$level->id")}}'>
                        <i class="fa fa-door-open"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop
