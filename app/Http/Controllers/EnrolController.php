<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Program;
use App\Level;
use App\Strand;
use App\Enrol;
use App\Classes;
use App\EnrolClass;
use App\Section;
use Illuminate\Support\Facades\DB;

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

        if($prg->category != $lev->category) {
            return redirect()->back()->with('Error','Invalid Program and Level combination');
        }

        if($lev->category!='shs' && $strand!=null){
            return redirect()->back()->with('Error','Only Senior High School have Strands.');
        }

        $enrol = Enrol::create([
            'student_id' => $request['student_id'],
            'program_id' => $request['program_id'],
            'period_id' => $request['period_id'],
            'level_id' => $request['level_id'],
            'strand_id' => $request['strand_id'],
            'section_id' => $request['section_id'],
            'type' => $request['type'],
        ]);

        if($request['section_id']) {
            Section::enrolClasses($enrol->id, $request['section_id']);
        }

        return redirect("/enrols/$enrol->id/show")->with('Info','Enrolment transaction completed.');
    }

    public function show(Enrol $enrol) {
        return view('enrols.view', compact('enrol'));
    }

    public function addClass(Request $request, Enrol $enrol) {
        $err = [];

        $codes = explode(",", $request['class_codes']);

        foreach($codes as $code) {
            if($class = Classes::find($code)) {
                if($conflict = $enrol->checkConflict($class)) {

                    $err[] = str_pad($class->id,5,'0',false) . " " . $class->scheduleText . " is in conflict with "
                        . $conflict->class->course->code . " " . $conflict->class->scheduleText;

                }else {

                    EnrolClass::create([
                        'enrol_id'=>$enrol->id,
                        'class_id'=>$class->id
                    ]);

                }
            }else {
                $err[] = "The code $code cannot be found.";
            }
        }

        return redirect()->back()->with('Error', implode("<br>", $err));
    }

    public function removeClass(Enrol $enrol, Request $request) {

        $class = Classes::find($request['class_id']);

        DB::table('enrol_classes')
            ->where('enrol_id',$request['enrol_id'])
            ->where('class_id',$request['class_id'])
            ->delete();

        return redirect("/enrols/$enrol->id/show")->with('Info',
                $class->course->code . " " . $class->scheduleText ." has been removed.");

    }

    public function createOrOpen(Request $request) {
        $stud = Student::find($request['student_id']);
        if($stud) {
            return redirect("/enrols/$stud->id");
        }else {
            return redirect()->back()->with('Error',"Student ID {$request['student_id']} cannot be found.");
        }
    }

    public function edit(Enrol $enrol) {
        return view('enrols.edit', ['enrol'=>$enrol]);
    }

    public function update(Enrol $enrol, Request $request) {
        $this->validate($request, [
            'level_id' => 'required|numeric',
            'program_id' => 'required|numeric',
            'period_id' => 'required|numeric',
            'type' => 'required'
        ]);

        $sectionId = $enrol->section_id;

        $enrol->update($request->all());

        $sectionMsg = "";

        if($sectionId!=$request['section_id']) {
            Section::removeEnrolClasses($enrol->id, $sectionId);
            $sectionMsg = " Classes from previous enrolled section has been removed.";
            if($request['section_id']!=null) {
                Section::enrolClasses($enrol->id, $request['section_id']);
                $sectionMsg .= " Classes from new enrolled section has been added.";
            }
        }

        return redirect("/enrols/$enrol->id/show")->with('Info', "Enrolment has been updated.$sectionMsg");

    }
}
