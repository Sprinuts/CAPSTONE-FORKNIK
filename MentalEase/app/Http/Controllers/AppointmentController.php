<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Users;

class AppointmentController extends Controller
{
    public function selectPsychometrician()
    {
        $psychometricians = Users::where('role', 'psychometrician')->get();
        return view('include/header')
            .view('include/navbar')
            .view('appointment.select', compact('psychometricians'));
    }

    public function chooseSchedule(Request $request, $psychometrician_id)
    {
        $now = \Carbon\Carbon::now();
        $schedules = Schedule::where('psychometrician_id', $psychometrician_id)
            ->where('scheduled', false)
            ->where('date', '>', $now->toDateString())
            ->get();
        return view('include/header')
            .view('include/navbar')
            .view('appointment.choose', compact('schedules', 'psychometrician_id'));
    }

    public function payment(Request $request)
    {
        // Temporarily store details before confirming
        return view ('include/header')
            .view('include/navbar')
            .view('appointment.payment', ['data' => $request->all()]);
    }

    public function confirm(Request $request)
    {
        // Create the appointment
        Appointment::create([
            'user_id' => $request->user_id,
            'psychometrician_id' => $request->psychometrician_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => \Carbon\Carbon::parse($request->start_time)->addHour(),
        ]);

        // Update the schedule's 'scheduled' column to true
        Schedule::where('psychometrician_id', $request->psychometrician_id)
            ->where('date', $request->date)
            ->where('start_time', $request->start_time)
            ->update(['scheduled' => true]);

        return redirect()->route('appointment.success')->with('success', 'Appointment Confirmed!');
    }

    public function success()
    {
        return view ('include/header')
            .view('include/navbar')
            .view('appointment.success');
    }
}