@extends('main')

@section('content')
<h1>Class Attendance</h1>
<div style="font-size: 1.2em; font-weight: bold; border-bottom: 1px solid #aaa">{{$class->course->description}}</div>

<?php $cols = 5; ?>

<table class="table table-bordered table-sm">
    <thead class="bg-dark text-white">
        <tr>
            <th rowspan="3" class="center">Students</th>
            <th colspan="6" class="center">May</th>
        </tr>
        <tr class="center">
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th>28</th>
        </tr>
        <tr class="center">
            <th>M</th>
            <th>T</th>
            <th>W</th>
            <th>Th</th>
            <th>F</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="{{$cols+1}}">(Male)</td>
        </tr>
        @foreach($class->enrolClasses('male') as $en)
        <tr>
            <td><strong>{{$en->enrol->student->lname}}, {{$en->enrol->student->fname}}</strong></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="{{$cols+1}}">(Female)</td>
        </tr>
        @foreach($class->enrolClasses('female') as $en)
        <tr>
            <td><strong>{{$en->enrol->student->lname}}, {{$en->enrol->student->fname}}</strong></td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
