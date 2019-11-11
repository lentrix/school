<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $fillable = ['accronym', 'name', 'dept_id', 'category'];

    public function department() {
        return $this->belongsTo('App\Department', 'dept_id');
    }

    public function courses() {
        return $this->hasMany('App\Course');
    }

    public function enrols() {
        return $this->hasMany('App\Enrol', 'program_id');
    }
}
