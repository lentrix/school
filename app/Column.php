<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Column extends Model
{
    public $timestamps = false;

    protected $dates = ['date'];

    protected $fillable = ['term', 'score','title', 'date', 'type_id'];

    public function colType() {
        return $this->belongsTo('App\ColType','type_id','id');
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }

    public function scoresForEditing() {
        return DB::table('scores')->where('column_id', $this->id)
                // ->join('enrol_classes','enrol_classes.enrol_id','scores.enrol_id')
                ->join('enrols','enrols.id','scores.enrol_id')
                ->join('students', 'students.id','enrols.student_id')
                ->select(['scores.id', 'lname','fname','mname','score'])
                ->orderBy('lname')->orderBy('fname')
                ->get();
    }

}
