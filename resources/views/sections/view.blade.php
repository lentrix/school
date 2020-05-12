@extends('main')

@section('content')

<h1>View Section</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/sections')}}">Sections</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$section->name}}</li>
    </ol>
</nav>

<div class="row row-eq-height">
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3>
                    Section Details
                    <a href='{{url("/sections/$section->id/edit")}}' class="btn btn-primary float-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Name</th><td>{{$section->name}}</td>
                    </tr>
                    <tr>
                        <th>Program</th><td>{{$section->program->accronym}}</td>
                    </tr>
                    <tr>
                        <th>Level</th><td>{{$section->level->name}}</td>
                    </tr>
                    <tr>
                        <th>Home Room</th><td>{{$section->room->name}}</td>
                    </tr>
                    <tr>
                        <th>Adviser</th><td>{{$section->user->fullName}}</td>
                    </tr>
                    <tr>
                        <th>Period</th><td>{{$section->period->name}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="card card-primary">
            <div class="card-header">

                <h3>Classes</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                @foreach($section->classes as $class)

                    <a href='{{url("/classes/$class->id/view")}}' class="list-group-item list-group-item-action">
                        <strong>{{$class->course->code}}</strong> | {{$class->course->description}} <br>
                        {!!$class->getScheduleTextAttribute(1)!!}
                    </a>

                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>
                    Student List
                    <button class="btn btn-primary float-right">
                        <i class="fa fa-print"></i>
                    </button>
                </h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($section->enrols as $index=>$enrol)

                    <a href='{{url("/enrols/$enrol->id/show")}}' class="list-group-item list-group-item-action">
                        {{$index+1}}. {{$enrol->student->fullName}}
                    </a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop
