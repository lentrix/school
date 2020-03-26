<div class="modal fade" id="removeClassModal" tabindex="-1" role="dialog" aria-labelledby="removeClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeClassModalLabel">Remove Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{Form::open(['url'=>"/enrols/$enrol->id/remove-class",'method'=>'delete'])}}
        <div class="modal-body">
          <p>Are you sure about removing <span id="item" class="text-primary"></span> from this enrolment?</p>
          <input type="hidden" name="enrol_id" id="enrol_id">
          <input type="hidden" name="class_id" id="class_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Remove</button>
        </div>
        {{Form::close()}}
      </div>
    </div>
</div>
