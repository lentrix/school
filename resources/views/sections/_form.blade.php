    <div class="form-group">
        <?= Form::label('period_id', 'School Period'); ?>
        <?= Form::select('period_id', \App\Period::listEnrolment(),
            null,['class'=>'form-control','placeholder'=>'Select a period']); ?>
    </div>

    <div class='form-group'>
        <?= Form::label('name', 'Name'); ?>
        <?= Form::text('name',null,['class'=>'form-control']); ?>
    </div>

    <div class="form-group">
        <?= Form::label('program_id', 'Program'); ?>
        <?= Form::select('program_id', \App\Program::pluck('name','id'), null,
                ['class' => 'form-control', 'placeholder'=>'Select program']); ?>
    </div>

    <div class="form-group">
        <?= Form::label('level_id', 'Level'); ?>
        <?= Form::select('level_id',
            \App\Level::pluck('name','id'),
            null,['class'=>'form-control', 'placeholder'=>'Select a level']); ?>
    </div>

    <div class="form-group">
        <?= Form::label('user_id', 'Adviser'); ?>
        <?= Form::select('user_id', \App\User::list(),
            null,['class'=>'form-control', 'placeholder'=>'Select a teacher']); ?>
    </div>

    <div class="form-group">
        <?= Form::label('room_id', 'Room'); ?>
        <?= Form::select('room_id',\App\Room::list(),
            null, ['class'=>'form-control','placeholder'=>'Select room']); ?>
    </div>
