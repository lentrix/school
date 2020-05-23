<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ColType;
use App\Column;
use App\EnrolClass;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingController extends Controller
{
    public function index(Classes $class) {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $totals = [];

        $urlTerm = $this->getTerm($class);

        foreach($class->colTypes as $type) {
            $totals[$type->id] = Score::totals($urlTerm, $type->id);
        }

        return view('classes.grading', [
            'class'=>$class,
            'terms' => $this->getTerms($class),
            'urlTerm' => $urlTerm,
            'totals' => $totals,
        ]);
    }

    public function gradeSettings(Classes $class) {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }
        return view('classes.grade-settings', compact('class'));
    }

    public function addType(Classes $class, Request $request) {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $this->validate($request,[
            'name' => 'required',
            'weight' => 'required|numeric',
        ]);

        ColType::create([
            'class_id' => $class->id,
            'name' => $request['name'],
            'short_name' => $request['short_name'],
            'weight' => $request['weight'],
            'remarks' => $request['remarks']
        ]);

        return redirect("classes/$class->id/grade-settings")->with('Info','Column Type added.');
    }

    public function deleteType(Classes $class, Request $request) {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        DB::table('col_types')->where('id', $request['id'])->delete();
        return redirect()->back()->with('Info','The column type and its columns have been deleted.');
    }

    public function create(Classes $class, Request $request) {
        //check ownership
        if ($class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $col = Column::create([
            'term' => $request['term'],
            'title' => $request['title'],
            'type_id' => $request['type_id'],
            'date' => $request['date'],
            'score' => $request['score']
        ]);

        foreach($class->enrolClasses() as $enrolClass) {
            Score::create([
                'column_id' => $col->id,
                'enrol_id' => $enrolClass->enrol_id
            ]);
        }

        return redirect("/columns/$col->id");
    }

    public function edit(Column $column) {
        //check ownership
        if ($column->colType->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $terms = $this->getTerms($column->colType->class);
        return view('classes.edit-column', ['column'=>$column, 'terms'=>$terms]);
    }

    public function update(Column $column, Request $request) {
        //check ownership
        if ($column->colType->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $column->update([
            'title' => $request['title'],
            'date' => $request['date'],
            'score' => $request['score']
        ]);

        foreach($request['scores'] as $id=>$score) {
            DB::table('scores')->where('id', $id)->update(['score'=>$score]);
        }

        return redirect("/classes/{$column->colType->class_id}/columns?term=" . $column->term)->with('Info','The scores and column details have been saved');
    }

    private function getTerms($class) {
        $cat = $class->program->category;

        if($cat=="college") {
            $terms = ['pr'=>'Prelim','md'=>'Midterm','sf'=>'Semi Final','fn'=>'Final'];
        }else if($cat=="shs") {
            if(substr($class->period->accronym,0,1)=="1"){
                $terms = ['q1'=>'First Quarter','q2'=>'Second Quarter'];
            }else {
                $terms = ['q3'=>'Third Quarter','q4'=>'Fourth Quarter'];
            }
        }else{
            $terms = ['q1'=>'First Quarter','q2'=>'Second Quarter', 'q3'=>'Third Quarter','q4'=>'Fourth Quarter'];
        }

        return $terms;
    }

    private function getTerm($class) {
        if(isset($_GET['term'])) {
            $urlTerm = $_GET['term'];
        }else if($rCol = $class->recentColumn()) {
            $urlTerm = $rCol->term;
        }else if($class->program->category=="college") {
            $urlTerm = 'pr';
        }else {
            $urlTerm = 'q1';
        }

        return $urlTerm;
    }

    public function viewType(ColType $type) {
        //check ownership
        if ($type->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }
        $urlTerm = $this->getTerm($type->class);

        $cols = $type->columns($urlTerm)->get();

        $scores = [];
        foreach($cols as $col ) {
            $scores[$col->id] = $col->scoresForEditing($urlTerm);
        }

        // dd($scores);

        return view('classes.view-type', [
            'urlTerm' => $urlTerm,
            'terms' => $this->getTerms($type->class),
            'type' => $type,
            'cols' => $cols,
            'scores' => $scores,
        ]);
    }

    public function sync(Column $column) {
        //check ownership
        if ($column->colType->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $ens = EnrolClass::whereNotIn('enrol_id', Score::where('column_id', $column->id)->pluck('enrol_id'))
                ->where('class_id', $column->colType->class_id)
                ->get();
        foreach($ens as $en) {
            Score::create([
                'column_id' => $column->id,
                'enrol_id' => $en->enrol_id,
                'score' => 0
            ]);
        }

        return redirect()->back()->with('Info', 'Column has been synced.');
    }

    public function delete(Column $column) {
        //check ownership
        if ($column->colType->class->user_id != auth()->user()->id) {
            redirect()->back()->with('Error', 'Sorry you are not the teacher of this class.');
        }

        $typeId = $column->type_id;
        $term = $column->term;
        $title = $column->title;

        $column->delete();

        return redirect("/types/$typeId?term=$term")->with('Info', "The column '$title' has been deleted.");
    }
}
