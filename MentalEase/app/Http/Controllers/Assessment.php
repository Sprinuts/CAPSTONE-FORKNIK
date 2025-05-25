<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Assessment extends Controller
{
    public function stress()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/stress');
    }

    public function stressassessment()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/stressassessment');
    }

    public function emotional()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/emotional');
    }

    public function emotionalassessment()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/emotionalassessment');
    }
}
