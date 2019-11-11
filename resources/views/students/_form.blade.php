
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-sm">
                <tr>
                    <th><?= Form::label('id', 'ID Number'); ?></th>
                    <td><?= Form::text('id',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('lrn', 'LRN'); ?></th>
                    <td><?= Form::text('lrn',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('lname', 'Last Name'); ?></th>
                    <td><?= Form::text('lname',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('fname', 'First Name'); ?></th>
                    <td><?= Form::text('fname',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('mname', 'Middle Name'); ?></th>
                    <td><?= Form::text('mname',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('bdate', 'Birth Date'); ?></th>
                    <td><?= Form::date('bdate',isset($student) ? $student->bdate : null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('gender', 'Gender'); ?></th>
                    <td>
                        <?= Form::radio('gender', 'female',false,['id'=>'female']); ?><label for="female"> Female</label>
                        <?= Form::radio('gender', 'male',false,['id'=>'male']); ?><label for="male"> Male</label>
                    </td>
                </tr>
                <tr>
                    <th><?= Form::label('phone', 'Phone'); ?></th>
                    <td><?= Form::text('phone',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('religion', 'Religion'); ?></th>
                    <td><?= Form::text('religion',null, ['class'=>'form-control']); ?></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="table table-sm">
                <tr>
                    <th><?= Form::label('barangay', 'Barangay'); ?></th>
                    <td><?= Form::text('barangay',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('town', 'Town'); ?></th>
                    <td><?= Form::text('town',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('province', 'Province'); ?></th>
                    <td><?= Form::text('province',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('citizenship', 'Citizenship'); ?></th>
                    <td><?= Form::text('citizenship',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('mother', 'Mother\'s Name'); ?></th>
                    <td><?= Form::text('mother',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('mphone', 'Mother\'s Phone'); ?></th>
                    <td><?= Form::text('mphone',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('father', "Father's Name"); ?></th>
                    <td><?= Form::text('father',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('fphone', "Father's Phone"); ?></th>
                    <td><?= Form::text('fphone',null, ['class'=>'form-control']); ?></td>
                </tr>
                <tr>
                    <th><?= Form::label('pr_address', "Parent's Address"); ?></th>
                    <td><?= Form::text('pr_address',null, ['class'=>'form-control']); ?></td>
                </tr>

            </table>
        </div>
    </div>


