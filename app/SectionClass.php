<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionClass extends Model
{
    protected $table = "section_classes";
    protected $fillable = ['section_id', 'class_id'];

}
