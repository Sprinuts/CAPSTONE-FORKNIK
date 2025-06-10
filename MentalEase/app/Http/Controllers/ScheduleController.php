<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function create()
    {
        $psychometrician = session('user');
        $schedules = Schedule::where('psychometrician_id', $psychometrician->id)->get();

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('schedule.create', compact('psychometrician', 'schedules'))
            .view('include/footer');
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
            .view('schedule/scheduleview', compact('schedules', 'psychometrician'))
            .view('include/footer');
    }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->query('date');
        $psychometricianId = $request->query('psychometrician_id');

        // Already booked times
        $booked = Schedule::where('psychometrician_id', $psychometricianId)
            ->where('date', $date)
            ->where('scheduled', false)
            ->pluck('start_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        // All possible time slots (8am-5pm excluding lunch)
        $allSlots = [];
        for ($hour = 8; $hour <= 17; $hour++) {
            if ($hour != 12 && $hour != 13) {
                $allSlots[] = sprintf('%02d:00', $hour);
            }
        }

        $available = array_diff($allSlots, $booked);

        return response()->json(array_values($available));
    }
}
