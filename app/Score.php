<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    public $timestamps = false;

    protected $fillable = ['column_id', 'enrol_id', 'score'];

    public function column() {
        return $this->belongsTo('App\Column');
    }

    public function enrolClass() {
        $classId = $this->column->colType->class_id;
        return $this->belongsTo('App\EnrolClass', 'enrol_id', 'enrol_id')->where('class_id', $classId);
    }

    public static function total($enrolId, $term, $typeId) {
        return Score::where('enrol_id', $enrolId)
            ->whereHas("column", function($q) use ($term, $typeId) {
                $q->where('term', $term)->where('type_id', $typeId);
            })->sum('score');
    }

    public static function totals($term, $typeId) {
        $raw = DB::select(DB::raw(
            "SELECT enrol_id, sum(score) AS total from scores
            WHERE column_id IN (select id from columns where type_id=$typeId AND term='$term') group by enrol_id "));

        $totals = [];

        foreach($raw as $data) {
            $totals[$data->enrol_id] = $data->total;
        }

        return $totals;
    }
}
