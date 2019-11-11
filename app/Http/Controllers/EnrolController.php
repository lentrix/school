<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Program;
use App\Level;
use App\Strand;
use App\Enrol;

class EnrolController extends Controller
{
    public function enrol(Student $student) {
        if($enrol = $student->activeEnrolment) {
            return redirect("/enrols/$enrol->id/show");
        }else {
            return view('enrols.enrolment', compact('student'));
        }
    }

    public function store(Request $request) {
        $this->validate($request, [
            'student_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'program_id' => 'required|numeric',
            'period_id' => 'required|numeric',
            'type' => 'required'
        ]);

        $prg = Program::find($request['program_id']);
        $lev = Level::find($request['level_id']);
        $strand = Strand::find($request['strand_id']);



        $enrol = Enrol::create([
            'student_id' => $request['student_id'],
            'program_id' => $request['program_id'],
            'period_id' => $request['period_id'],
            'level_id' => $request['level_id'],
            'strand_id' => $request['strand_id'],
            'section_id' => $request['section_id'],
            'type' => $request['type'],
        ]);

        return redirect("/enrols/$enrol->id")->with('Info','Enrolment transaction completed.');
    }

    public function show() {
        return "Hello";
    }
}
