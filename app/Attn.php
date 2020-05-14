<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attn extends Model
{
    public $timestamps = false;

    protected $fillable = ['classes_id','remarks','date'];

    public function attnChecks() {
        return $this->hasMany('App\AttnCheck');
    }

    public function class() {
        return $this->belongsTo('App\Classes','classes_id');
    }
}
