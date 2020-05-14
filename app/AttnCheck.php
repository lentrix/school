<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttnCheck extends Model
{
    protected $fillable = ['attn_id', 'enrol_id', 'att'];

    public function attendance() {
        return $this->belongsTo('App\Attn');
    }

    public function enrol() {
        return $this->belongsTo('App\Enrol');
    }

    public static function get($attnId, $enrolId) {
        return static::where('attn_id', $attnId)->where('enrol_id', $enrolId)->first();
    }
}
