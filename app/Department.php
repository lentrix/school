<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = null;

    public $fillable = ['accronym', 'name'];

    public function users() {
        return $this->hasMany('App\User', 'dept_id');
    }

    public function programs() {
        return $this->hasMany('App\Program', 'dept_id');
    }

    public static function list() {
        return static::orderBy('name')
            ->pluck('name','id')
            ->all();
    }
}
