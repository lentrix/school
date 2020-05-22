@extends('main')

@section('content')

<!-- Modal -->
<div class="modal fade" id="addColumnModal" tabindex="-1" role="dialog" aria-labelledby="addColumnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addColumnModalLabel">Add Column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>"/classes/$type->class_id/add-column", 'method'=>'post']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('term')}}
                    {{Form::select('term',$terms,$urlTerm,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title')}}
                    {{Form::text('title',null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label("type_id", 'Column Type')}}
                    {{Form::select('type_id',$type->class->colTypes->pluck('name','id'),$type->id,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('date')}}
                    {{Form::date('date',null, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('score','Max Score')}}
                    {{Form::number('score',null,['class'=>'form-control'])}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Column</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
        <li class="breadcrumb-item"><a href='{{url("/classes/$type->class_id/columns")}}?term={{$urlTerm}}'>Class Grading</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$type->name}}</li>
    </ol>
</nav>

<div class="float-right">
    <a href='{{url("/classes/$type->class_id/grade-settings")}}' class="btn btn-success">
        <i class="fa fa-cog"></i> Grade Settings
    </a>
    <button class="btn btn-primary" data-target="#addColumnModal" data-toggle="modal">
        <i class="fa fa-plus"></i> Add Column
    </button>
</div>

<h1>Class Grading</h1>

<div style="font-size: 1.2em; font-weight: bold; border: 1px solid #aaa; padding: 5px; margin-bottom: 10px;">

    {{$type->class->course->description}} | {{$type->class->scheduleText}}
    <div class="float-right" style="font-size: 0.8em">
        <label for="term">Select Term: </label>
        <select name="term" id="term_select">
            @foreach($terms as $t=>$term)
            <option value="{{$t}}" {{$t==$urlTerm ? "selected" : ""}}>{{$term}}</option>
            @endforeach
        </select>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">Student</th>
            <th colspan="{{count($cols)}}" class="center">
                {{$terms[$urlTerm]}} : {{$type->name}}
            </th>
        </tr>
        <tr>
            @foreach($cols as $col)
            <th class="center">
                <a href='{{url("/columns/$col->id")}}' class="link">
                    {{$col->title}} ({{$col->score}})
                </a>
            </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($type->class->enrolClasses() as $i=>$en)

        <tr>
            <td>{{$i+1}}</td>
            <td>{{$en->lname}}, {{$en->fname}}</td>
            @foreach($scores as $idx=>$scoreSet)
                <td class="center">
                    {{isset($scoreSet[$i])?$scoreSet[$i]->score:"-"}}
                </td>
            @endforeach
        </tr>

        @endforeach
    </tbody>
</table>

@stop


@section('scripts')

<script>
    $(document).ready(function(){
        $("#term_select").change(function(evt){
            var term = $("#term_select option:selected").val();
            if(term) window.location = '{{url("/types/$type->id")}}' + '?term=' + term;
        })
    })
</script>

@stop
