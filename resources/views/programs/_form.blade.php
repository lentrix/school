<div class="form-group">
    {{Form::label('accronym')}}
    {{Form::text('accronym',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('name')}}
    {{Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('category')}}
    {{Form::select('category',
        [
            'pre-elem' => 'Pre Elementary',
            'elem' => 'Elementary',
            'jhs' => 'Junior High School',
            'shs' => 'Senior High School',
            'college' => 'College',
            'gs' => 'Graduate School'
        ],
        null,['class'=>'form-control', 'placeholder'=>'Select category'])}}
</div>
<div class="form-group">
    {{Form::label('dept_id','Department')}}
    {{Form::select('dept_id',\App\Department::orderBy('name')->pluck('name', 'id'),
            null,['class'=>'form-control','placeholder'=>'Select Department'])}}
</div>
