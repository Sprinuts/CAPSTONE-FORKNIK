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

    public function appointmentsview()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $appointments = Appointment::where('psychometrician_id', $user->id)->get();
        foreach ($appointments as $appointment) {
                if ($appointment->user_id) {
                    $client = \App\Models\Users::find($appointment->user_id);
                    $appointment->client = $client;
                } else {
                    $appointment->psychometrician = null;
                }
            }

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentview', [
                'appointments' => $appointments
            ]);
    }

    public function appointmentsshow($id)
    {
        $appointment = Appointment::findOrFail($id);
        $client = Users::find($appointment->user_id);
        $psychometrician = Users::find($appointment->psychometrician_id);

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentshow', [
                'appointment' => $appointment,
                'client' => $client,
                'psychometrician' => $psychometrician
            ]);
    }

    public function appointmentsedit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment.edit', [
                'appointment' => $appointment
            ]);
    }

    public function appointmentscomplete(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        return redirect()->route('appointments.show', $id)
            ->with('success', 'Appointment marked as completed.');
    }
}