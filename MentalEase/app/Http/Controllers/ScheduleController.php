<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function create()
    {
        $psychometrician = session('user');
        $schedules = Schedule::where('psychometrician_id', $psychometrician->id)->get();

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('schedule.create', compact('psychometrician', 'schedules'));
    }

    public function store(Request $request)
    {
        Schedule::create([
            'psychometrician_id' => $request->psychometrician_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => \Carbon\Carbon::parse($request->start_time)->addHour(),
        ]);

        return redirect()->back()->with('success', 'Schedule added.');
    }

    public function view()
    {
        $psychometrician = session('user');
        $schedules = Schedule::where('psychometrician_id', $psychometrician->id)->get();

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('schedule/scheduleview', compact('schedules', 'psychometrician'));
    }
}
