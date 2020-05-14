@extends('main')


@section('content')

@include("classes._delete_attn")

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
        <h2>Students</h2>
        <ul class="list-group">
            @foreach($attn->attnChecks as $attnCheck)
            <li class="list-group-item">
                {{$attnCheck->enrol->student->lname}}, {{$attnCheck->enrol->student->fname}}
                <span class="float-right">

                    {{Form::radio("attn[$attnCheck->id]",'pr', $attnCheck->att=='pr',['id'=>"pr_$attnCheck->id"])}}
                    {{Form::label("pr_$attnCheck->id",'Present')}}

                    {{Form::radio("attn[$attnCheck->id]",'lt', $attnCheck->att=='lt',['id'=>"lt_$attnCheck->id"])}}
                    {{Form::label("lt_$attnCheck->id",'Late')}}

                    {{Form::radio("attn[$attnCheck->id]",'ab', $attnCheck->att=='ab',['id'=>"ab_$attnCheck->id"])}}
                    {{Form::label("ab_$attnCheck->id",'Absent')}}
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

{!! Form::close() !!}
@stop
