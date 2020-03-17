<div class="modal fade" id="removeSchedModal" tabindex="-1" role="dialog" aria-labelledby="removeSchedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeSchedModalLabel">Remove Schedule?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action='{{url("/classes/remove-sched")}}'>
                {{csrf_field()}}
            <div class="modal-body">
                <p>Are you sure you want to delete this schedule (serial# <span id="idshow"></span> )?</p>
                <table class="table table-bordered">
                    <tr class="bg-primary text-white">
                        <th>Time</th>
                        <th>Days</th>
                        <th>Venue</th>
                    </tr>
                    <tr>
                        <td><span id="time"></span></td>
                        <td><span id="xdays"></span></td>
                        <td><span id="venue"></span></td>
                    </tr>
                </table>
                <input type="hidden" name="sched_id" id="sched_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Remove Schedule</button>
            </div>
            </form>
        </div>
    </div>
</div>
