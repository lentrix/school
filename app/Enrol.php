<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrol extends Model
{
    public $fillable = ['student_id', 'program_id','strand_id', 'level_id', 'type', 'status', 'period_id'];


    public function student() {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function level() {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function program() {
        return $this->belongsTo('App\Program', 'program_id');
    }

    public function period() {
        return $this->belongsTo('App\Period', 'period_id');
    }

    public function enrolClasses() {
        return $this->hasMany('App\EnrolClass', 'enrol_id');
    }

    public function strand() {
        return $this->belongsTo('App\Strand', 'strand_id');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function schedules() {
        $sc = \App\Schedule::whereRaw('classes_id IN
            (SELECT enrol_classes.class_id FROM enrol_classes WHERE enrol_id=' . $this->id . ')');
        return $sc->get();
    }
}
