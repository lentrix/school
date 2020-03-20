<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Schedule extends Model
{
    public $fillable = ['classes_id', 'room_id', 'start', 'end', 'days'];

    public function class() {
        return $this->belongsTo('App\Classes', 'classes_id');
    }

    public function room() {
        return $this->belongsTo('App\Room');
    }

    public function getFullTextAttribute() {
        return $this->start . "-" . $this->end . " " . $this->days;
    }

    public static function checkClassConflict($start, $end, $days, $room_id) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();
        foreach(explode(',', $days) as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('days','like',"%$day%")
            ->where('room_id',$room_id)
            ->with('class')
            ->whereHas('class', function($query) {
                $query->whereHas('period', function($qry){
                    $qry->whereNotIn('status',['close', 'pending']);
                })->with('period');
            })
            ->first();

            if($sched) return $sched;
        }
        return null;
    }

    public static function checkTeacherConflict($start, $end, $days, $teacher_id) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();
        foreach(explode(',', $days) as $day) {
            $qry = Classes::where('teacher_id',$teacher_id)
                    ->whereHas('period', function($query) {
                        $query->whereNotIn('status',['pending','expired']);
                    })->whereHas('schedules', function($query) use ($start, $startPlus, $end, $endMinus, $day) {
                        $query->where('days','like',"%$day%")
                              ->whereBetween('start', [$start,$endMinus])
                              ->orWhereBetween('end',[$startPlus,$end]);
                    })->with('course')->with('schedules')
                    ->first();

            if($qry) return $qry;
        }

        return null;
    }

    public static function checkTwo(Schedule $sched1, Schedule $sched2) {
        //check days
        $daysConflict = count(
            array_intersect(explode(",", $sched1->days), explode(",", $sched2->days))) > 0;

        $s1 = strtotime($sched1->start);
        $s2 = strtotime($sched2->start);
        $e1 = strtotime($sched1->end);
        $e2 = strtotime($sched2->end);

        $timeConflict = ($s1>=$s2 && $s1<$e2) || ($s2>=$s1 && $s2<$e1);

        return $daysConflict && $timeConflict;

    }
}
