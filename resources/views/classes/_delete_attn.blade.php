<div class="modal fade" id="deleteAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="deleteAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAttendanceModalLabel">Delete Attendance?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>"/attn/$attn->id", 'method'=>'delete']) !!}
            <div class="modal-body">
                <p>Are you sure you want to delete this attendance record?</p>
                <input type="hidden" name="sched_id" id="sched_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Attendance</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
