
<div class="form-group">
    {{Form::label('accronym')}}
    {{Form::text('accronym',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('name')}}
    {{Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('start','Start (dd/mm/yyyy)')}}
    {{Form::date('start',isset($period) ? $period->start:null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('end','End (dd/mm/yyyy)')}}
    {{Form::date('end',isset($period) ? $period->end:null,['class'=>'form-control'])}}
</div>
