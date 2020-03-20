<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deactivateModalLabel">Deactivate Venue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{Form::open(['url'=>"/venues/$room->id",'method'=>'delete'])}}
        <div class="modal-body">
          <p>Are you certain about deactivating this venue?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Deactivate</button>
        </div>
        {{Form::close()}}
      </div>
    </div>
</div>
