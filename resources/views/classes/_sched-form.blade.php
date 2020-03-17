<!-- Modal -->
<div class="modal fade" id="schedFormModal" tabindex="-1" role="dialog" aria-labelledby="schedFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="schedFormModalLabel">Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>"/classes/$class->id/add-sched",'method'=>'post']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('start')}}
                            {{Form::time('start',null,['class'=>'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('end')}}
                            {{Form::time('end',null,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('days')}}
                            {{Form::text('days',null,['class'=>'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('room_id','Venue')}}
                            {{Form::select('room_id',
                                    $rooms, null,
                                    ['class'=>'form-control','placeholder'=>'Select venue'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Schedule</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
