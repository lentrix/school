@extends('main')

@section('content')

<h1>Welcome!</h1>

<div class="row row-eq-height">
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>App Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm table-bordered">
                    <tr><th>Active Period</th></tr>
                    <tr>
                        <td>
                            2nd Sem AY 2019-2029 <br>
                            School Year 2019-2020
                        </td>
                    </tr>
                    <tr><th>Student Population</th></tr>
                    <tr><td>???</td></tr>
                    <tr><th>Teacher Population</th></tr>
                    <tr><td>???</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>Notifications</h3>
            </div>
            <div class="card-body">
                No notifications.
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-primary" style="height: 100%">
            <div class="card-header">
                <h3>Recent Logs</h3>
            </div>
            <div class="card-body">
                No logs yet.
            </div>
        </div>
    </div>
</div>

@stop
