<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Course;
use App\Period;
use App\Section;
use App\Program;
use App\Department;
use App\EnrolClass;
use App\User;
use App\Schedule;
use App\Room;
use Illuminate\Support\Facades\DB;

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

        if($message=$this->checkClassConflicts(
                $request['start'], $request['end'],
                $dayStr, $request['room_id'])) {
            return redirect()->back()->with('Error',$message);
        }

        if($message=$this->checkTeacherConflicts(
                $request['start'], $request['end'], $dayStr, $class->user_id))
        {
            return redirect()->back()->with('Error', $message);
        }

        if($class->section_id != null) {

            $conflict = Schedule::checkSectionConflict($request['start'], $request['end'], $dayStr, $class->section_id);
            if($conflict) {
                return redirect()->back()->with(
                    'Error',
                    "The new schedule is in conflict with {$conflict->class->course->code} $conflict->fullText within the section {$class->section->name}");
            }
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

    private function checkClassConflicts($start, $end, $dayStr, $room_id) {
        $conflict = Schedule::checkClassConflict(
            $start, $end,
            $dayStr, $room_id);

        $message = false;

        if($conflict) {
            $message = "This schedule is in conflict with " . $conflict->class->course->code
                . " " . $conflict->start . "-" . $conflict->end . " " . $conflict->days
                . " " . $conflict->room->name;
        }
        return $message;
    }

    private function checkTeacherConflicts($start, $end, $dayStr, $teacher_id) {
        $conflict = Schedule::checkTeacherConflict($start, $end, $dayStr, $teacher_id);
        $message = false;
        if($conflict) {
            $message = "This schedule is in conflict with teacher "
            . $conflict->class->user->fullName . " on class "
            . $conflict->class->course->code . " " . $conflict->start
            . "-" . $conflict->end . " " . $conflict->days;
        }
        return $message;
    }

    public function sectionSync(Classes $class) {
        $missing = DB::table('enrols')->where('section_id', $class->section_id)
            ->whereNotIn('id', DB::table('enrol_classes')->where('class_id', $class->id)->pluck('enrol_id'))
            ->pluck('id');

        foreach($missing as $item) {
            EnrolClass::create([
                'enrol_id' => $item,
                'class_id' => $class->id
            ]);
        }

        return redirect("/classes/$class->id/view")->with('Info','This class has been synced with its section.');
    }
}
