<?php

namespace App\Http\Controllers;

use App\Models\Theory;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function index(){
        $theories = Theory::all();

        return view('description.index', compact('theories'));
    }

    public function show(Theory $theory){
        return view('description.show', compact('theory'));
    }
}
