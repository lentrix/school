<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Classes;
use App\Schedule;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('name')->paginate(20);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'period_id' => 'required|numeric',
            'name' => 'required',
            'program_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'room_id' => 'required|numeric',
        ]);

        $section = Section::create($request->all());

        return redirect("/sections/$section->id")->with('Info','New Section has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('sections.view', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $this->validate($request,[
            'period_id' => 'required|numeric',
            'name' => 'required',
            'program_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'room_id' => 'required|numeric',
        ]);

        $section->update($request->all());


        return redirect("/sections/$section->id")->with('Info','Section has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addClassesForm(Section $section) {
        $classes = Classes::where('period_id', $section->period_id)
            ->whereNull('section_id')
            ->join('courses', 'courses.id', 'classes.course_id')
            ->orderBy('courses.code')
            ->select('classes.*')
            ->get();
        return view('sections.add-classes', ['classes'=>$classes, 'section'=>$section]);
    }

    public function addClasses(Section $section, Request $request) {
        $count = 0;
        foreach($request['class_id'] as $index=>$id) {
            $class = Classes::find($id);
            if($class) {
                foreach($class->schedules as $sched) {
                    $conflict = Schedule::checkSectionConflict($sched->start, $sched->end, $sched->days, $section->id);
                    if($conflict) {
                        return redirect()->back()->with(
                            'Error',
                            "{$class->course->code} is in conflict with {$conflict->class->course->code} $conflict->fullText");
                    }
                }
                $class->section_id = $section->id;
                $class->save();
                $section->addSectionEnrolClasses($class->id);
                $count++;
            }else {
                dd($class, $id);
            }
        }

        return redirect("/sections/$section->id/")->with('Info',"$count classes added to this section.");
    }


}
