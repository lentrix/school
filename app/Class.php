<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function getStudentList() {
        return Enrol::whereHas('enrolClasses', function($query){
            $query->where('class_id', $this->id);
        })->with('student')->get();
    }
}
