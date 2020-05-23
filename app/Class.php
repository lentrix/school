<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    public $tableName = "classes";
    public $fillable = ['course_id', 'period_id', 'teacher_id', 'credit_units',
        'pay_units','user_id', 'program_id', 'department_id', 'section_id'];

    public function course() {
        return $this->belongsTo('App\Course');
    }

    public function period() {
        return $this->belongsTo('App\Period');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function program() {
        return $this->belongsTo('App\Program');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function colTypes() {
        return $this->hasMany('App\ColType','class_id');
    }

    public function getScheduleTextAttribute($break=false) {
        if(count($this->schedules)==0) {
            return 'Unscheduled';
        }else {
            $str = "";
            foreach($this->schedules as $index=>$sched) {
                $breakOrAmp = $break ? "<br>" : " & ";
                $pre = $index>0 ? $breakOrAmp : "";
                $str .= $pre . "$sched->start-$sched->end $sched->days " . $sched->room->code;
            }
            return substr($str, 0, strlen($str)-2);
        }
    }

    public function enrolClasses($gender=null) {
        $q = DB::table('enrol_classes')->where('class_id', $this->id)
            ->join('enrols', 'enrols.id','enrol_classes.enrol_id')
            ->join('students', 'students.id', 'enrols.student_id')
            ->orderByRaw('lname, fname');

        if($gender) {
            $q->where('gender', $gender);
        }

        return $q->get();
    }

    public function recentColumn() {
        $col = Column::whereHas('colType', function($q) {
            $q->where('class_id', $this->id);
        })->orderBy('date','desc')->first();

        return $col;
    }
}
