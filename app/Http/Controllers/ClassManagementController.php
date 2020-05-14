<?php

namespace App\Http\Controllers;

use App\Attn;
use App\AttnCheck;
use Illuminate\Http\Request;
use App\Classes;
use Illuminate\Support\Facades\DB;

class ClassManagementController extends Controller
{
    public function attendance(Classes $class, $month)
    {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attns = Attn::whereMonth('date', date('m'))->get();

        return view('classes.attendance', ['class' => $class, 'attns'=>$attns]);
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

        foreach($class->enrolClasses() as $enc) {
            AttnCheck::create([
                'attn_id' => $attn->id,
                'enrol_id' => $enc->enrol_id,
                'att' => 'pr'
            ]);
        }

        return redirect("/attn/$attn->id/edit");
    }

    public function editAttendance(Attn $attn) {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        return view('classes.update-attn', ['attn'=>$attn]);
    }

    public function updateAttendance(Request $request, Attn $attn) {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attn->update([
            'date' => $request['date'],
            'remarks' => $request['remarks']
        ]);

        foreach($request['attn'] as $id=>$att) {
            DB::table('attn_checks')->where('id', $id)->update(['att'=>$att]);
        }

        $m = date('m');
        return redirect("/classes/$attn->classes_id/attn/$m");
    }

    public function deleteAttendance(Attn $attn) {
        //check ownership
        if ($attn->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $attn->delete();

        $m = date('m');
        return redirect("/classes/$attn->classes_id/attn/$m")->with('Info','Attendance record has been deleted.');
    }
}
