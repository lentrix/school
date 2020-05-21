@extends('main')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteColTypeModal" tabindex="-1" role="dialog" aria-labelledby="deleteColTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteColTypeModalLabel">Delete Column Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>"/classes/$class->id/delete-type", 'method'=>'post']) !!}
        <div class="modal-body">
          You are about to delete <span id="column_type_name" class="text-primary"></span> column type. <br>
          Please take note that deleting this column type will result in the deletion of all
          columns under this column type. <br><span style="color: red">Please proceed with caution!!!</span>
          <input type="hidden" name="id" id="column_type_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Column Type</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/users/load")}}'>Teaching Load</a></li>
      <li class="breadcrumb-item"><a href='{{url("/classes/$class->id/columns")}}'>Class Grading</a></li>
      <li class="breadcrumb-item active" aria-current="page">Grade Settings</li>
    </ol>
</nav>

<h1>Grade Settings</h1>
<div style="font-size: 1.2em; font-weight: bold; border: 1px solid #aaa; padding: 5px; margin-bottom: 10px;">
    {{$class->course->description}} | {{$class->scheduleText}}
</div>

<div class="row">
    <div class="col-md-3">
        <h3>Add Type</h3>

        {!! Form::open(['url'=>"/classes/$class->id/add-type", 'method'=>'post']) !!}

        <div class="form-group">
            {{Form::label('name')}}
            {{Form::text('name',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('short_name')}}
            {{Form::text('short_name',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('weight')}}
            {{Form::text('weight',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('remarks')}}
            {{Form::text('remarks',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-plus"></i> Add Type
            </button>
        </div>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h3>Grading Types</h3>
        <table class="table table-bordered table-striped">
            <thead class="bg-primary">
                <th>Name</th>
                <th>Short Name</th>
                <th>Weight</th>
                <th>Remarks</th>
                <th>...</th>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                @foreach($class->colTypes as $colType)

                <tr>
                    <td>{{$colType->name}}</td>
                    <td>{{$colType->short_name}}</td>
                    <td>{{$colType->weight}}</td>
                    <td>{{$colType->remarks}}</td>
                    <td class="center">
                        <button class="btn btn-sm btn-danger remove-type" type="button" title="Delete Column Type"
                                data-toggle="modal" data-target="#deleteColTypeModal"
                                data-id="{{$colType->id}}" data-name="{{$colType->name}}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
                <?php $total += $colType->weight; ?>

                @endforeach
            </tbody>
        </table>
        <p>
            <strong>TOTAL WEIGHT: {{$total}}</strong>
        </p>
    </div>
</div>

@stop

@section('scripts')

<script>
    $(document).ready(function(){
        $(".remove-type").click(function(){
            var name = $(this).attr('data-name');
            var id = $(this).attr('data-id');

            $("#column_type_name").text(name);
            $("#column_type_id").val(id);

            console.log(name, id);
        })
    })
</script>

@stop
