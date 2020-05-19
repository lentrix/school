@extends('main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
      <li class="breadcrumb-item active" aria-current="page">Class Attendance</li>
    </ol>
</nav>

<?php $monthStr = ['','January','February','March','April','May','June','July','August','September','October','November','December']; ?>

<div class="float-right">
    <a href='{{url("/classes/$class->id/attn/create")}}' class="btn btn-primary">
        <i class="fa fa-plus"></i> New
    </a>
</div>

<h1>Class Attendance</h1>
<div style="font-size: 1.2em; font-weight: bold; border: 1px solid #aaa; padding: 5px; margin-bottom: 10px;">
    {{$class->course->description}} | {{$class->scheduleText}}

    <div class="float-right" style="font-size: 0.8em">
        <label for="month">Month:</label>
        <select name="month" id="month">
            @foreach($months as $m)
                <option value="{{$m->month}}" {{$month==$m->month ? "selected":""}}>{{$monthStr[$m->month]}}</option>
            @endforeach
        </select>
    </div>
</div>

<?php $cols = count($attns); ?>

<table class="table table-bordered table-sm">
    <thead class="bg-dark text-white">
        <tr>
            <th rowspan="3" class="center">Students</th>
            <th colspan="{{$cols}}" class="center">{{$monthStr[$month]}}</th>
        </tr>
        <tr class="center">
            @foreach($attns as $attn)
            <th>
                <a href='{{url("/attn/$attn->id/edit")}}'>{{date('d', strtotime($attn->date))}}</a>
            </th>
            @endforeach
        </tr>
        <tr class="center">
            @foreach($attns as $attn)
            <td>{{date('D', strtotime($attn->date))}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="{{$cols+1}}">(Male)</td>
        </tr>

        <?php $symbol = ['pr'=>'fa-check', 'lt'=>'fa-clock', 'ab'=>'fa-times']; ?>

        @foreach($class->enrolClasses('male') as $en)
        <tr>
            <td><strong>{{$en->enrol->student->lname}}, {{$en->enrol->student->fname}}</strong></td>
            @foreach($attns as $attn)
            <td class="center">
                <?php $check = \App\AttnCheck::get($attn->id, $en->enrol_id)?>
                @if($check) <i class="fa {{$symbol[$check->att]}}"></i> @endif
            </td>
            @endforeach
        </tr>
        @endforeach
        <tr>
            <td colspan="{{$cols+1}}">(Female)</td>
        </tr>
        @foreach($class->enrolClasses('female') as $en)
        <tr>
            <td><strong>{{$en->enrol->student->lname}}, {{$en->enrol->student->fname}}</strong></td>
            @foreach($attns as $attn)
            <td class="center">
                <?php $check = \App\AttnCheck::get($attn->id, $en->enrol_id)?>
                @if($check) <i class="fa {{$symbol[$check->att]}}"></i> @endif
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
        $("#month").change(function(evt){
            var value = evt.target.selectedOptions[0].value;
            window.location='{{url("/classes/$class->id/attn")}}' + "/" + value;
        })
    })
</script>

@stop
