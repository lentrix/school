<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Course;
use App\Period;
use App\Section;
use App\Program;
use App\Department;
use App\User;
use App\Schedule;
use App\Room;

class ClassesController extends Controller
{
    public function index() {
        $recent = Classes::orderBy('updated_at','desc')
            ->whereHas('period', function($query){
                $query->where('status','enrol');
            })
            ->with('course')
            ->limit(20)->get();
        return view('classes.index',['classes'=>$recent]);
    }

    public function create() {
        $courses = Course::list();
        $periods = Period::listEnrolment();
        $sections = Section::list();
        $programs = Program::list();
        $departments = Department::list();
        $users = User::list();

        return view('classes.create',[
            'courses' => $courses,
            'periods' => $periods,
            'sections' => $sections,
            'programs' => $programs,
            'departments' => $departments,
            'users' => $users
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'course_id' => 'required|numeric',
            'period_id' => 'required|numeric',
            'credit_units' => 'required|numeric',
            'pay_units' => 'required|numeric',
        ]);

        $userId = auth()->user()->id;

        $class = Classes::create([
            'course_id' => $request['course_id'],
            'period_id' => $request['period_id'],
            'user_id' => $request['user_id'],
            'section_id' => $request['section_id'],
            'program_id' => $request['program_id'],
            'department_id' => $request['department_id'],
            'credit_units' => $request['credit_units'],
            'pay_units' => $request['pay_units'],
        ]);

        return redirect("/classes/$class->id/view");
    }

    public function view(Classes $class) {
        $rooms = Room::list();
        return view('classes.view', ['class'=>$class,'rooms'=>$rooms]);
    }

    public function addSched(Request $request, Classes $class) {
        $this->validate($request, [
            'room_id'=>'required|numeric',
            'start' => 'required',
            'end' => 'required',
            'days' => 'required',
        ]);

        $dayStr = implode(',', $request['days']);

        $conflict = Schedule::checkClassConflict(
            $request['start'], $request['end'],
            $dayStr, $request['room_id']);

        if($conflict) {
            $message = "This schedule is in conflict with " . $conflict->class->course->code
                . " " . $conflict->start . "-" . $conflict->end . " " . $conflict->days
                . " " . $conflict->room->name;

            return redirect()->back()->with('Error',$message);
        }

        $schedule = Schedule::create([
            'room_id' => $request['room_id'],
            'start' => $request['start'],
            'end' => $request['end'],
            'days' => $dayStr,
            'classes_id' => $class->id,
        ]);

        return redirect()->back()->with('Info','Schedule added.');
    }

    public function edit(Classes $class) {
        $courses = Course::list();
        $periods = Period::listEnrolment();
        $sections = Section::list();
        $programs = Program::list();
        $departments = Department::list();
        $users = User::list();

        return view("classes.edit",[
            'class'=>$class,
            'courses' => $courses,
            'periods' => $periods,
            'sections' => $sections,
            'programs' => $programs,
            'departments' => $departments,
            'users' => $users
        ]);
    }

    public function update(Classes $class, Request $request) {
        $this->validate($request, [
            'course_id' => 'required|numeric',
            'period_id' => 'required|numeric',
            'credit_units' => 'required|numeric',
            'pay_units' => 'required|numeric',
        ]);

        $class->update($request->all());

        return redirect("/classes/$class->id/view")->with('Info','This class has been updated.');
    }

    public function removeSched(Request $request) {
        $sched = Schedule::find($request['sched_id']);
        $classId = $sched->class->id;
        $sched->delete();

        return redirect("/classes/$classId/view")->with('Info','A schedule has been removed.');
    }
}
