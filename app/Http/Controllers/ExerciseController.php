<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Theory;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(){
        $exercises = Exercise::all();
        return view('exercise.index', compact('exercises'));
    }

    public function show(Exercise $exercise){
        return view('exercise.show'/*, compact('exercise')*/);
    }
}
