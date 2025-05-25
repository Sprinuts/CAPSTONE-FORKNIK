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
        return view('appointment.select', compact('psychometricians'));
    }

    public function chooseSchedule(Request $request, $psychometrician_id)
    {
        $schedules = Schedule::where('psychometrician_id', $psychometrician_id)->get();
        return view('appointment.choose', compact('schedules', 'psychometrician_id'));
    }

    public function payment(Request $request)
    {
        // Temporarily store details before confirming
        return view('appointment.payment', ['data' => $request->all()]);
    }

    public function confirm(Request $request)
    {
        Appointment::create([
            'user_id' => $request->user_id,
            'psychometrician_id' => $request->psychometrician_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => \Carbon\Carbon::parse($request->start_time)->addHour(),
            'payment_status' => true,
        ]);

        return redirect()->route('appointment.success')->with('success', 'Appointment Confirmed!');
    }

    public function success()
    {
        return view('appointment.success');
    }
}