@extends('main')


@section('content')

@include("classes._delete_attn")

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
      <li class="breadcrumb-item"><a href='{{url("/classes/$attn->classes_id/attn/" . date('m')*1)}}'>Class Attendance</a></li>
      <li class="breadcrumb-item active" aria-current="page">Attendance Check</li>
    </ol>
</nav>

<h1>Attendance Check</h1>
<div style="font-size: 1.2em; font-weight: bold; border: 1px solid #aaa; padding: 5px; margin-bottom: 10px;">
    {{$attn->class->course->description}} | {{$attn->class->scheduleText}}
</div>

{!! Form::open(['url'=>"/attn/$attn->id/update",'method'=>'post']) !!}

<div class="row">
    <div class="col-md-5">
        <h3>Attendance Details</h3>
        <table class="table table-bordered">
            <tr>
                <th>
                    {{Form::label('date')}}
                </th>
                <td>
                    {{Form::date('date', $attn->date, ['class'=>'form-control'])}}
                </td>
            </tr>
            <tr>
                <th>
                    {{Form::label('remarks')}}
                </th>
                <td>
                    {{Form::text('remarks',$attn->remarks,['class'=>'form-control'])}}
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-7">
        <div class="float-right">
            <a href='{{url("/attn/$attn->id/sync")}}' class="btn btn-secondary">
                <i class="fa fa-sync-alt"></i> Sync
            </a>
        </div>
        <h2>Students</h2>
        <ul class="list-group">
            @foreach($list as $item)
            <li class="list-group-item">
                {{$item->lname}}, {{$item->fname}}
                <span class="float-right">

                    {{Form::radio("attn[$item->id]",'pr', $item->att=='pr',['id'=>"pr_$item->id"])}}
                    {{Form::label("pr_$item->id",'Present')}}

                    {{Form::radio("attn[$item->id]",'lt', $item->att=='lt',['id'=>"lt_$item->id"])}}
                    {{Form::label("lt_$item->id",'Late')}}

                    {{Form::radio("attn[$item->id]",'ab', $item->att=='ab',['id'=>"ab_$item->id"])}}
                    {{Form::label("ab_$item->id",'Absent')}}
                </span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<hr>

<button class="btn btn-primary btn-lg" type="submit">
    <i class="fa fa-check"></i> Save Attendance
</button>

<button class="btn btn-danger btn-lg" data-target="#deleteAttendanceModal" type="button" data-toggle="modal">
    <i class="fa fa-times"></i> Delete
</button>

<?php $mo = date('m', strtotime($attn->date))*1; ?>

<a href='{{url("/classes/{$attn->classes_id}/attn/$mo")}}' class="btn btn-secondary">Back</a>

{!! Form::close() !!}
@stop
