<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $fillable = ['code', 'type','description','units', 'hours','academic','program_id'];

    public function program() {
        return $this->belongsTo('App\Program');
    }

    public function programName() {
        return $this->program?$this->program->accronym:'none';
    }

    public function deptName() {
        return $this->program?$this->program->department->accronym:'none';
    }

    public function classes() {
        return $this->hasMany('App\Classes');
    }

    public function isAcademic() {
        return $this->academic?'Academic':'Non-academic';
    }

    public static function list() {
        // return static::orderBy('description')->pluck('description','id');
        $courses = static::orderBy('description')
            ->with('program')
            ->get()
            ->keyBy('id')
            ->map(function($item) {
                return $item->description . " (" . $item->program->accronym . ")";
            });
        return $courses;
    }
}
