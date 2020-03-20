<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Schedule;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('name')->get();
        return view('venues.index',['rooms'=>$rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venues.create');
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
            'code'=>'required',
            'name'=>'required',
            'capacity'=>'required|numeric',
        ]);

        $room = Room::create($request->all());

        return redirect("/venues/$room->id")->with('Info','New venue created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        $schedules = Schedule::where('room_id', $id)
            ->whereHas('class', function($query) {
                $query->whereHas('period', function($qry) {
                    $qry->whereNotIn('status',['close','pending']);
                })->with('course')->with('user');
            })->with('class')->get();

        return view('venues.view',['room'=>$room, 'schedules'=>$schedules]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);

        return view('venues.edit', ['room'=>$room]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $this->validate($request,[
            'code'=>'required',
            'name'=>'required',
            'capacity'=>'required|numeric',
        ]);

        $room->update($request->all());

        return redirect("/venues/$room->id")->with('Info','This venue has been updated.');
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
