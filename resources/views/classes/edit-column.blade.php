@extends('main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
        <li class="breadcrumb-item"><a href='{{url("/classes/{$column->colType->class_id}/columns")}}'>Class Grading</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Column</li>
    </ol>
</nav>

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
        </div>
    </div>
</div>
{!! Form::close() !!}

@stop
