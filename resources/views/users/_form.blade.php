<div class="row">

    <div class="col">
        <div class="form-group">
            {{Form::label('username')}}
            {{Form::text('username',null, ['class'=>'form-control'])}}
        </div>

        @if($create)
        <div class="form-group">
            {{Form::label('password')}}
            {{Form::password('password', ['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('password_repeat','Repeat Password')}}
            {{Form::password('password_confirmation', ['class'=>'form-control'])}}
        </div>
        @endif

        <div class="form-group">
            {{Form::label('lname','Last Name')}}
            {{Form::text('lname',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('fname','First Name')}}
            {{Form::text('fname',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('mname','Middle Name')}}
            {{Form::text('mname',null, ['class'=>'form-control'])}}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{Form::label('address')}}
            {{Form::text('address',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone')}}
            {{Form::text('phone',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('field')}}
            {{Form::text('field',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('dept_id', 'Department')}}
            {{Form::select('dept_id', \App\Department::orderBy('accronym')->pluck('name','id'),
                    null, ['class'=>'form-control','placeholder'=>'Select department'])}}
        </div>
    </div>
</div>
