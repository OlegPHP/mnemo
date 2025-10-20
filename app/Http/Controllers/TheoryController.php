<?php

namespace App\Http\Controllers;

use App\Models\Theory;
use Illuminate\Http\Request;

class TheoryController extends Controller
{
    public function index(){
        $theories = Theory::all();
        return view('theory.index', compact('theories'));
    }

    public function show(Theory $theory){
        return view('theory.show', compact('theory'));
    }
}
