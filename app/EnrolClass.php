<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolClass extends Model
{
    protected $fillable = ['enrol_id', 'class_id'];

    public function enrol() {
        return $this->belongsTo('App\Enrol', 'enrol_id');
    }

    public function class() {
        return $this->belongsTo('App\Classes', 'class_id');
    }

}
