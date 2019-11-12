<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    protected $fillable = ['track','strand'];

    public function enrols() {
        return $this->hasMany('App\Enrol', 'strand_id');
    }

    public function getIdentityStringAttribute() {
        return $this->track . " " . $this->strand;
    }

    public static function list() {
        $list = [];

        foreach(static::orderBy('track')->get() as $strand) {
            $list[$strand->id] = $strand->identityString();
        }

        return $list;
    }
}
