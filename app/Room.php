<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    public $fillable = ['code','name','building','floor','capacity'];

    public static function buildings() {
        return DB::table('rooms')
            ->selectRaw('DISTINCT building')
            ->orderBy('building')
            ->pluck('building');
    }

    public static function list() {
        return static::orderBy('name')
            ->where('active',1)
            ->pluck('name','id');
    }
}
