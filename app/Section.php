<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function list() {
        $list = [];

        return static::whereHas('period', function($query){
                $query->whereNotIn('status',['closed','pending','expired']);
            })->orderBy('name')->pluck('name','id');
    }

    /**
     * Add enrol_classes when changing the section of an enrol
     */
    public static function enrolClasses($enrol_id, $section_id) {
        $classes = Classes::where('section_id', $section_id)->get();
        $data = [];
        foreach($classes as $class) {
            $data[] = [
                'enrol_id' => $enrol_id,
                'class_id' => $class->id
            ];
        }

        EnrolClass::insert($data);
    }

    /**
     * Remove enrol_classes when change the section of an enrol
     */
    public static function removeEnrolClasses($enrolId, $sectionId) {
        DB::table('enrol_classes')
                ->whereIn('class_id', DB::table('classes')->where('section_id', $sectionId)->pluck('id'))
                ->where('enrol_id', $enrolId)
                ->delete();
    }

    /**
     * Add enrol_classes when adding a class to a section
     */
    public function addSectionEnrolClasses($classId) {

        $enrols = Enrol::where('section_id', $this->id)->get();

        $data = [];
        foreach($enrols as $enrol) {
            $data[] = [
                'enrol_id' => $enrol->id,
                'class_id' => $classId
            ];
        }

        EnrolClass::insert($data);
    }

    /**
     * Remove enrol_classes when remove a class from a section
     */
    public function removeSectionEnrolClasses($classId) {

    }
}
