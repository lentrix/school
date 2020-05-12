<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('updated_at','desc')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'units' => 'required|numeric',
            'hours' => 'numeric',
            'academic' => 'required',
        ]);

        $course = Course::create($request->all());

        return redirect("/courses/$course->id")->with('Info','New Course created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $classes = \App\Classes::where('course_id', $course->id)->get();
        return view('courses.view',[
            'course' => $course,
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'description' => 'required',
            'units' => 'required|numeric',
            'hours' => 'numeric',
            'academic' => 'required',
        ]);

        $course->update($request->all());

        return redirect("/courses/$course->id")->with('Info','Course has been updated.');
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

    public function search(Request $request) {
        $courses = Course::where('code','like',"%{$request['search']}%")
                    ->orWhere('description','like',"%{$request['search']}%")
                    ->orWhere('id', $request['search'])
                    ->get();
        return view('courses.index', compact('courses'));
    }
}
