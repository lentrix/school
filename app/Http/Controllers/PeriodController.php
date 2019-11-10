<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;

class PeriodController extends Controller
{
    public function index() {
        $periods = Period::orderBy('start','desc')->paginate(10);
        return view('periods.index', compact('periods'));
    }

    public function search(Request $request) {
        $periods = Period::where('accronym', 'like', "%{$request['search']}%")
                    ->orWhere('name', 'like', "%{$request['search']}%")
                    ->orderBy('id','desc')
                    ->get();

        return view('periods.index', compact('periods'));
    }

    public function edit(Period $period) {
        return view('periods.edit', ['period'=>$period]);
    }

    public function update(Period $period, Request $request) {
        $this->validate($request, [
            'accronym' => 'required',
            'name' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $period->update([
            'accronym' => $request['accronym'],
            'name' => $request['name'],
            'start' => $request['start'],
            'end' => $request['end']
        ]);

        return redirect("/periods")->with('Info',"Period $period->accronym has been updated.");
    }

    public function create() {
        return view('periods.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'accronym' => 'required',
            'name' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $period = Period::create([
            'accronym' => $request['accronym'],
            'name' => $request['name'],
            'start' => $request['start'],
            'end' => $request['end']
        ]);

        return redirect("/periods/$period->id")->with('Info','New Period has been created.');
    }

    public function changeStatus(Period $period, Request $request) {
        $period->status = $request['status'];
        $period->save();

        return redirect("/periods/$period->id")->with('Info',"Period $period->accronym has changed to $period->status");
    }
}
