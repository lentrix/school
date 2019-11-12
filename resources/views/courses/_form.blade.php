<div class="form-group">
    {{Form::label('code','Course Code')}}
    {{Form::text('code', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description')}}
    {{Form::text('description', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('units')}}
    {{Form::text('units', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('program_id', 'Program')}}
    {{Form::select('program_id',
        \App\Program::orderBy('name')->pluck('name','id'),
        null, ['class'=>'form-control', 'placeholder'=>'Select a program'])}}
</div>
<div class="form-group">
    {{Form::radio('academic', 1, null,['id'=>'academic'])}}
    {{Form::label('academic','Academic',['for'=>'academic'])}}
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    {{Form::radio('academic', 0, null,['id'=>'non-academic'])}}
    {{Form::label('non-academic','Non Academic')}}
</div>
