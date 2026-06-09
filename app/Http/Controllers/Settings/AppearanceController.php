<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class AppearanceController extends Controller
{
    public function edit()
    {
        return view('settings.appearance');
    }

    public function update()
    {
        return back()->with('status', 'saved');
    }
}