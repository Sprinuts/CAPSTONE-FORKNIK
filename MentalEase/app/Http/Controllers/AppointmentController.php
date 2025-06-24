<?php

namespace App\Http\Controllers;
use App\Mail\Sendrefund;
use Illuminate\Support\Facades\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Users;
use App\Models\Invoice;

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

        $appointments = Appointment::where('psychometrician_id', $user->id)
            ->where('complete', false)
            ->where('cancelled', false)
            ->get();
        foreach ($appointments as $appointment) {
                if ($appointment->user_id) {
                    $client = Users::find($appointment->user_id);
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

    public function appointmentsviewconfirmed()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $appointments = Appointment::where('psychometrician_id', $user->id)
            ->where('confirmed', true)
            ->where('cancelled', false)
            ->where('complete', false)
            ->get();
        foreach ($appointments as $appointment) {
                if ($appointment->user_id) {
                    $client = Users::find($appointment->user_id);
                    $appointment->client = $client;
                } else {
                    $appointment->psychometrician = null;
                }
            }

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentviewconfirmed', [
                'appointments' => $appointments
            ]);
    }

    public function appointmentsconfirmation()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $appointments = Appointment::where('psychometrician_id', $user->id)
            ->where('confirmed', false)
            ->where('cancelled', false)
            ->where('complete', false)
            ->get();
        foreach ($appointments as $appointment) {
                if ($appointment->user_id) {
                    $client = Users::find($appointment->user_id);
                    $appointment->client = $client;
                } else {
                    $appointment->psychometrician = null;
                }
            }

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentconfirmation', [
                'appointments' => $appointments
            ]);
    }

    public function appointmentsshowconfirmation($id)
    {
        $appointment = Appointment::findOrFail($id);
        $client = Users::find($appointment->user_id);
        $psychometrician = Users::find($appointment->psychometrician_id);

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentshowconfirmation', [
                'appointment' => $appointment,
                'client' => $client,
                'psychometrician' => $psychometrician
            ]);
    }

    public function appointmentconfirming(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->confirmed = true;
        $appointment->save();

        return redirect()->route('appointments.view', $id)
            ->with('success', 'Appointment confirmed successfully.');
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
        $appointment->complete = true;
        $appointment->save();

        // Mark the corresponding schedule as complete
        Schedule::where('psychometrician_id', $appointment->psychometrician_id)
            ->where('date', $appointment->date)
            ->where('start_time', $appointment->start_time)
            ->update(['complete' => true]);

        return redirect()->route('appointments.view', $id)
            ->with('success', 'Appointment marked as completed.');
    }

    public function appointmentspatientview()
    {
        $user = session('user');

        $appointments = Appointment::where('user_id', $user->id)
            ->where('complete', false)
            ->where('cancelled', false)
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->first();

        if ($appointments->psychometrician_id) {
                $psychometrician = Users::find($appointments->psychometrician_id);
                $appointments->psychometrician = $psychometrician;
            } else {
                $appointments->psychometrician = null;
            }

        return view('include/header')
            .view('include/navbar')
            .view('appointment/patientview', compact('appointments'));
    }

    public function appointmentscancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->cancelled = true;
        $appointment->save();

        Schedule::where('psychometrician_id', $appointment->psychometrician_id)
            ->where('date', $appointment->date)
            ->where('start_time', $appointment->start_time)
            ->update(['scheduled' => false]);

        $user = session('user');
        $data['email'] = $user->email;

        $referencecode = Invoice::where('appointment_id', $appointment->id)
            ->value('reference_number');


        Mail::to($data['email'])->send(new Sendrefund($referencecode));

        return redirect()->route('welcomepatient')->with('success', 'Appointment cancelled successfully.');
    }

    public function appointmentsrecords()
    {
        $appointments = Appointment::all();
        foreach ($appointments as $appointment) {
            if ($appointment->user_id) {
                $client = Users::find($appointment->user_id);
                $appointment->client = $client;
            } else {
                $appointment->client = null;
            }
        }
        return view('include/header')
            .view('include/navbaradmin') // Changed from navbarpsychometrician to navbaradmin
            .view('appointment.records', [
                'appointments' => $appointments
            ]);
    }

    public function generatePdf()
    {
        $appointments = Appointment::all();
        foreach ($appointments as $appointment) {
            if ($appointment->user_id) {
                $client = Users::find($appointment->user_id);
                $appointment->client = $client;
            } else {
                $appointment->client = null;
            }
        }

        $pdf = Pdf::loadView('appointment/recordspdf', compact('appointments'));

        return $pdf->download('appointment.pdf');
    }
}
