<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Strand;
use App\Enrol;

class StrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strands = Strand::orderBy('track')->get();
        return view('strands.index', compact('strands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('strands.create');
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
            'strand' => 'required',
            'track' => 'required',
        ]);

        $strand = Strand::create($request->all());

        return redirect("/strands/$strand->id")->with('Info','New Strand created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Strand $strand)
    {
        $enrols = Enrol::where('strand_id', $strand->id)
                ->whereHas('period', function($query){
                    $query->whereNotIn('status',['close','pending']);
                })->whereHas('student',function($query){
                    $query->orderBy('lname')->orderBy('fname');
                })->get();

        return view("strands.view",[
            'strand' => $strand,
            'enrols' => $enrols
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Strand $strand)
    {
        return view('strands.edit', compact('strand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Strand $strand)
    {
        $this->validate($request, [
            'strand' => 'required',
            'track' => 'required',
        ]);

        $strand->update($request->all());

        return redirect("/strand/$strand->id")->with('Info','Strand has been updated.');
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
}
