<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;

class ClassManagementController extends Controller
{
    public function attendance(Classes $class) {
        return view('classes.attendance', ['class'=>$class]);
    }
}
