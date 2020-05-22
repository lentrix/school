<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColType extends Model
{
    public $timestamps = false;

    protected $fillable = ['class_id', 'name', 'short_name', 'weight', 'remarks'];

    public function class() {
        return $this->belongsTo('App\Classes');
    }

    public function columns($term=null) {
        $q = $this->hasMany('App\Column','type_id');
        if($term) {
            $q->where('term', $term);
        }
        return $q;
    }
}
