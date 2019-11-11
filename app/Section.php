<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'period_id', 'program_id', 'level_id', 'room_id','user_id'];

    public function program() {
        return $this->belongsTo('App\Program', 'program_id');
    }

    public function period() {
        return $this->belongsTo('App\Period', 'period_id');
    }

    public function level() {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function room() {
        return $this->belongsTo('App\Room', 'room_id');
    }

    public function classes() {
        return $this->hasMany('App\Classes','section_id');
    }

    public function enrols() {
        return $this->hasMany('App\Enrol');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function students() {
        return \App\Student::whereHas('enrols', function($query){
            $query->where('section_id', $this->id);
        })->with('enrols')
        ->orderBy('lname')->orderBy('fname')->get();
    }

    public function identityString() {
        return $this->program->accronym . " " . $this->level->code . " " . $this->name;
    }

    public static function active() {
        return static::whereHas('period', function($query) {
            $query->whereNotIn('status',['peding','closed']);
        })->orderBy('name')->get();
    }

    public function schedules() {
        return \App\Schedule::whereRaw(
            "classes_id IN (SELECT id FROM classes WHERE section_id=$this->id)")->get();
    }

    public static function list(\App\Enrol $enrol) {
        $list = [];
        foreach(static::where('program_id', $enrol->program_id)->where('level_id', $enrol->level_id)->get() as $section){
            $list[$section->id] = $section->name;
        }

        return $list;
    }
}
