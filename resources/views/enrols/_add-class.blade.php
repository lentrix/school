<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClassModalLabel">Add Classes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{Form::open(['url'=>"/enrols/$enrol->id/add-class",'method'=>'post'])}}
        <div class="modal-body">
          <p>Enter the class codes separated by comma ",".</p>
          <textarea name="class_codes" id="class_codes" rows="5" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Classes</button>
        </div>
        {{Form::close()}}
      </div>
    </div>
</div>
