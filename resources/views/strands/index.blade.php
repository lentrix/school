@extends('main')

@section('content')


<h1>
    Strands
    <a href="{{url('/strands/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Strand
    </a>
    <div class="float-right">
        <form action="{{url('/strands/search')}}" style="display:inline-block" method="get">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search" style="width: 300px">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-secondary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</h1>

@if(isset($_GET['search']))
<p>Search result for "{{$_GET['search']}}"</p>
@endif

<table class="table table-bordered table-sm">
    <thead>
        <tr class="table-info">
            <th>Track</th>
            <th>Strand</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($strands as $strand)

        <tr>
            <td>{{$strand->track}}</td>
            <td>{{$strand->strand}}</td>
            <td>
                <a href='{{url("/strands/$strand->id")}}' class="btn btn-secondary btn-sm">
                    <i class="fa fa-door-open"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
