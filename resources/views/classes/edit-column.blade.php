@extends('main')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteColumnModal" tabindex="-1" role="dialog" aria-labelledby="deleteColumnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteColumnModalLabel">Delete Column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        {!! Form::open(['url'=>"/columns/$column->id", 'method'=>'delete']) !!}
            <div class="modal-body">
                <div class="alert alert-danger">
                    You are about to delete this column "{{$column->title}}". This action will
                    consequently delete all the scores related to this column. <br>
                    Are you sure you want to delete this column?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Column</button>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
        <li class="breadcrumb-item"><a href='{{url("/classes/{$column->colType->class_id}/columns")}}'>Class Grading</a></li>
        <li class="breadcrumb-item"><a href='{{url("/types/$column->type_id")}}?term={{$column->term}}'>{{$column->colType->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$column->title}}</li>
    </ol>
</nav>

<div class="float-right">
    <a href='{{url("/columns/$column->id/sync")}}' class="btn btn-success">
        <i class="fa fa-sync-alt"></i> Sync Column
    </a>
</div>

<h1>Edit Column</h1>

{!! Form::open(['url'=>"/columns/$column->id",'method'=>'patch']) !!}
<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Description</th>
                <td>{{$column->colType->class->course->description}}</td>
            </tr>
            <tr>
                <th>Time Schedule</th>
                <td>{{$column->colType->class->scheduleText}}</td>
            </tr>
            <tr>
                <th>
                    {{Form::label('term')}}
                </th>
                <td>{{Form::select('term',$terms, $column->term,['class'=>'form-control'])}}</td>
            </tr>
            <tr>
                <th>{{Form::label('title','Column Title')}}</th>
                <td>{{Form::text('title',$column->title,['class'=>'form-control'])}}</td>
            </tr>
            <tr>
                <th>{{Form::label('date')}}</th>
                <td>{{Form::date('date',$column->date,['class'=>'form-control'])}}</td>
            </tr>
            <tr>
                <th>{{Form::label('score','Total Score')}}</th>
                <td>{{Form::number('score',$column->score,['class'=>'form-control'])}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <div class="list-group">
            @foreach($column->scoresForEditing() as $index=>$score)
            <div class="list-group-item">
                {{$index+1}}. {{$score->lname}}, {{$score->fname}} {{$score->mname}}
                <input type="number" name="scores[{{$score->id}}]"
                        class="float-right" style="width: 100px"
                        value="{{$score->score}}">
            </div>
            @endforeach
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-check"></i> Save Column
            </button>

            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteColumnModal">Delete Column</button>
        </div>
    </div>
</div>
{!! Form::close() !!}

@stop
