<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Enrol;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::orderBy('accronym')->get();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create');
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
            'accronym' => 'required',
            'name' => 'required',
            'category' => 'required',
            'dept_id' => 'required|numeric',
        ]);

        $program = Program::create($request->all());

        return redirect("/programs/$program->id")->with('Info','New program created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $enrols = Enrol::where('program_id', $program->id)
            ->with('student')->whereHas('student',function($query) {
                $query->orderBy('lname')->orderBy('fname');
            })->get();

        return view('programs.view', [
            'program'=>$program,
            'enrols' => $enrols
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request, [
            'accronym' => 'required',
            'name' => 'required',
            'category' => 'required',
            'dept_id' => 'required|numeric',
        ]);

        $program->update($request->all());

        return redirect("/programs/$program->id")->with('Info','Program has been updated.');
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
        $programs = Program::where('accronym','like',"%{$request['search']}%")
                    ->orWhere('name','like',"%{$request['search']}%")
                    ->orderBy('accronym')->get();
        return view('programs.index', compact('programs'));
    }
}
