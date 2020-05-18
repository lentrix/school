<?php

namespace App\Http\Controllers;

use App\Attn;
use App\AttnCheck;
use Illuminate\Http\Request;
use App\Classes;
use App\EnrolClass;
use Illuminate\Support\Facades\DB;

class ClassManagementController extends Controller
{
    public function attendance(Classes $class, $month)
    {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attns = Attn::whereMonth('date', date('m'))
            ->where('classes_id', $class->id)
            ->get();

        return view('classes.attendance', ['class' => $class, 'attns' => $attns]);
    }

    public function createAttendance(Classes $class)
    {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attn = Attn::create([
            'classes_id' => $class->id,
            'date' => date('Y-m-d')
        ]);

        foreach ($class->enrolClasses() as $enc) {
            AttnCheck::create([
                'attn_id' => $attn->id,
                'enrol_id' => $enc->enrol_id,
                'att' => 'pr'
            ]);
        }

        return redirect("/attn/$attn->id/edit");
    }

    public function editAttendance(Attn $attn)
    {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $list = DB::table('attn_checks')->where('attn_id', $attn->id)
            ->join('enrols', 'enrols.id', 'attn_checks.enrol_id')
            ->join('students', 'students.id', 'enrols.student_id')
                    ->orderBy('students.lname')
                    ->orderBy('students.fname')
            ->select(['attn_checks.id', 'students.lname', 'students.fname', 'students.mname', 'attn_checks.att'])
            ->get();

        return view('classes.update-attn', ['attn' => $attn, 'list'=>$list]);
    }

    public function updateAttendance(Request $request, Attn $attn)
    {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attn->update([
            'date' => $request['date'],
            'remarks' => $request['remarks']
        ]);

        foreach ($request['attn'] as $id => $att) {
            DB::table('attn_checks')->where('id', $id)->update(['att' => $att]);
        }

        $m = date('m');
        return redirect("/classes/$attn->classes_id/attn/$m");
    }

    public function deleteAttendance(Attn $attn)
    {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attn->delete();

        $m = date('m');
        return redirect("/classes/$attn->classes_id/attn/$m")->with('Info', 'Attendance record has been deleted.');
    }

    public function syncAttendance(Attn $attn)
    {
        $ids = EnrolClass::whereNotIn('enrol_id', AttnCheck::where('attn_id', $attn->id)->pluck('enrol_id'))
            ->where('class_id', $attn->classes_id)
            ->pluck('enrol_id');

        if (count($ids) > 0) {
            foreach($ids as $id) {
                AttnCheck::create([
                    'attn_id' => $attn->id,
                    'enrol_id' => $id,
                    'att' => 'ab'
                ]);
            }
        }

        return redirect("/attn/$attn->id/edit")->with('Info','Attendance List has been synced.');
    }
}
