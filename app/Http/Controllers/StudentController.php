<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index(Request $request) {

        $students=Student::orderBy('id','desc')->paginate(20);

        return view('students.index', compact('students'));
    }

    public function show(Student $student) {
        return view('students.view', compact('student'));
    }

    public function edit(Student $student) {
        return view('students.edit',['student'=>$student]);
    }

    public function create() {
        return view('students.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'lrn' => 'required|numeric',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'bdate' => 'required',
            'gender' => 'required',
            'barangay' => 'required',
            'town' => 'required',
            'province' => 'required',
        ]);

        $stud = Student::create($request->all());

        return redirect("/students/$stud->id")->with('Info','New student record created.');
    }

    public function update(Request $request, Student $student) {
        $this->validate($request, [
            'lrn' => 'required|numeric',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'bdate' => 'required',
            'gender' => 'required',
            'barangay' => 'required',
            'town' => 'required',
            'province' => 'required',
        ]);

        $student->update([
            'lrn' => $request['lrn'],
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'bdate' => $request['bdate'],
            'gender' => $request['gender'],
            'barangay' => $request['barangay'],
            'town' => $request['town'],
            'province' => $request['province'],
            'phone' => $request['phone'],
            'religion' => $request['religion'],
            'citizenship' => $request['citizenship'],
            'mother' => $request['mother'],
            'mphone' => $request['mphone'],
            'father' => $request['father'],
            'fphone' => $request['fphone'],
            'pr_address' => $request['pr_address'],
        ]);

        return redirect("/students/$student->id")->with('Info','Student record has been updated.');
    }

    public function search(Request $request) {
        $search = $request['search'];
        $students = Student::where('lname','like',"%$search%")
                        ->orWhere('fname','like',"%$search%")
                        ->orWhere('id', $search)
                        ->paginate(20);

        return view('students.index', ['students'=>$students]);
    }
}
