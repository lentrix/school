<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $fillable = ['accronym', 'name', 'start', 'end', 'type'];
    protected $dates = ['start', 'end'];

    public function classes() {
        return $this->hasMany('App\Classes');
    }

    public static function listEnrolment() {
        return static::where('status','enrol')->pluck('name', 'id');
    }

    public function enrols() {
        return $this->hasMany('App\Enrol', 'period_id');
    }

    public static function listActive() {
        return static::whereNotIn('status',['close','pending'])->pluck('name', 'id');
    }
}
