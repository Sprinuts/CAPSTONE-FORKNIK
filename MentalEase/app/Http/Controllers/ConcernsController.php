<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConcernsController extends Controller
{
    public function patientconcerns()
    {
        return view('include/headerhelpdesk')
            .view('include/navbarhelpdesk')
            .view('concerns/patientconcerns');
    }
}
