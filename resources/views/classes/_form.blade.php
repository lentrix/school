<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('course_id','Course')}}
            {{Form::select('course_id',
                $courses, null,
                ['class'=>'form-control','placeholder'=>'Select Course'])}}
        </div>
        <div class="form-group">
            {{Form::label('period_id','Period')}}
            {{Form::select('period_id',
                $periods, null,
                ['class'=>'form-control','placeholder'=>'Select Period'])}}
        </div>
        <div class="form-group">
            {{Form::label('credit_units')}}
            {{Form::number('credit_units',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('pay_units')}}
            {{Form::number('pay_units',null,['class'=>'form-control'])}}
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            {{Form::label('user_id','Teacher')}}
            {{Form::select('user_id',
                $users, null,
                ['class'=>'form-control','placeholder'=>'Select Section'])}}
        </div>
        <div class="form-group">
            {{Form::label('section_id','Section')}}
            {{Form::select('section_id',
                $sections, null,
                ['class'=>'form-control','placeholder'=>'Select Section'])}}
        </div>
        <div class="form-group">
            {{Form::label('program_id','Program')}}
            {{Form::select('program_id',
                $programs, null,
                ['class'=>'form-control','placeholder'=>'Select Program'])}}
        </div>
        <div class="form-group">
            {{Form::label('department_id','Department')}}
            {{Form::select('department_id',
                $departments, null,
                ['class'=>'form-control','placeholder'=>'Select Department'])}}
        </div>
    </div>
</div>
