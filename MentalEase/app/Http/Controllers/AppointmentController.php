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

    public function welcomepsychometrician()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        // Check for expired appointments first
        $this->checkExpiredAppointments();
        
        // Get today's date and current time
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $currentTime = \Carbon\Carbon::now();
        
        // Get today's appointments that are upcoming (not past)
        $todayUpcomingAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('date', $today)
            ->where('cancelled', false)
            ->where('complete', false)
            ->get()
            ->filter(function($appointment) use ($currentTime) {
                $appointmentDateTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->start_time);
                return $appointmentDateTime->greaterThan($currentTime);
            })
            ->values(); // Reset array keys
        
        // Get today's past appointments
        $todayPastAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('date', $today)
            ->where('cancelled', false)
            ->get()
            ->filter(function($appointment) use ($currentTime) {
                $appointmentDateTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->start_time);
                return $appointmentDateTime->lessThanOrEqualTo($currentTime);
            })
            ->values(); // Reset array keys
        
        // Count pending appointments
        $pendingAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('confirmed', false)
            ->where('cancelled', false)
            ->count();
        
        // Count total patients (unique users who have had appointments)
        $totalPatients = Appointment::where('psychometrician_id', $user->id)
            ->distinct('user_id')
            ->count('user_id');
        
        // Count completed appointments
        $completedAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('complete', true)
            ->count();

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('welcome/welcomepsychometrician', [
                'todayUpcomingAppointments' => $todayUpcomingAppointments,
                'todayPastAppointments' => $todayPastAppointments,
                'todayAppointmentsCount' => $todayUpcomingAppointments->count(), // Only count upcoming appointments
                'pendingAppointments' => $pendingAppointments,
                'totalPatients' => $totalPatients,
                'completedAppointments' => $completedAppointments
            ]);
    }

    public function appointmentview()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        // Get today's date
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        
        // Count pending appointments
        $pendingAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('confirmed', false)
            ->where('cancelled', false)
            ->count();
        
        // Count upcoming confirmed appointments
        $upcomingAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('confirmed', true)
            ->where('cancelled', false)
            ->where('complete', false)
            ->where('date', '>=', $today)
            ->count();
        
        // Get recent appointments (limit to 5)
        $recentAppointments = Appointment::where('psychometrician_id', $user->id)
            ->where('cancelled', false)
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->limit(5)
            ->get();
        
        foreach ($recentAppointments as $appointment) {
            if ($appointment->user_id) {
                $client = Users::find($appointment->user_id);
                $appointment->client = $client;
            } else {
                $appointment->client = null;
            }
        }

        return view('include/header')
            .view('include/navbarpsychometrician')
            .view('appointment/appointmentview', [
                'pendingAppointments' => $pendingAppointments,
                'upcomingAppointments' => $upcomingAppointments,
                'recentAppointments' => $recentAppointments
            ]);
    }

    public function appointmentviewconfirmed()
    {
        $user = session('user');
        if (!$user || $user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $appointments = Appointment::where('psychometrician_id', $user->id)
            ->where('cancelled', false)
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
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

        return redirect()->route('appointment.confirmation')
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

        return redirect()->route('appointment.viewconfirmed')
            ->with('success', 'Appointment marked as completed.');
    }

    public function checkExpiredAppointments()
    {
        $now = \Carbon\Carbon::now();
        
        // Find pending appointments that are past their scheduled time
        $expiredAppointments = Appointment::where('confirmed', false)
            ->where('cancelled', false)
            ->where('complete', false)
            ->where(function($query) use ($now) {
                $query->where('date', '<', $now->toDateString())
                    ->orWhere(function($q) use ($now) {
                        $q->where('date', '=', $now->toDateString())
                            ->where('start_time', '<', $now->format('H:i:s'));
                    });
            })
            ->get();
        
        // Mark expired appointments as cancelled
        foreach ($expiredAppointments as $appointment) {
            $appointment->cancelled = true;
            $appointment->save();
            
            // Update the schedule to be available again
            Schedule::where('psychometrician_id', $appointment->psychometrician_id)
                ->where('date', $appointment->date)
                ->where('start_time', $appointment->start_time)
                ->update(['scheduled' => false]);
        }
        
        return $expiredAppointments->count();
    }

    public function appointmentspatientview()
    {
        $user = session('user');
        
        // Check for expired appointments first
        $this->checkExpiredAppointments();
        
        $appointments = Appointment::where('user_id', $user->id)
            ->where('complete', false)
            ->where('cancelled', false)
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->first();

        if ($appointments && $appointments->psychometrician_id) {
            $psychometrician = Users::find($appointments->psychometrician_id);
            $appointments->psychometrician = $psychometrician;
        } else if ($appointments) {
            $appointments->psychometrician = null;
        }

        return view('include/header')
            .view('include/navbar')
            .view('appointment/patientview', compact('appointments'));
    }

    public function appointmentscancel($id)
    {
        $user = session('user');
        $appointment = Appointment::findOrFail($id);
        
        // Allow both patients and psychometricians to cancel appointments
        if (!$user || ($user->id != $appointment->user_id && $user->id != $appointment->psychometrician_id && $user->role != 'admin')) {
            return redirect()->back()->withErrors(['user' => 'Unauthorized access']);
        }
        
        $appointment->cancelled = true;
        $appointment->save();

        // Update the schedule to be available again
        Schedule::where('psychometrician_id', $appointment->psychometrician_id)
            ->where('date', $appointment->date)
            ->where('start_time', $appointment->start_time)
            ->update(['scheduled' => false]);

        // Only send refund email if it's a patient cancelling
        if ($user->role == 'patient') {
            $data['email'] = $user->email;
            $referencecode = Invoice::where('appointment_id', $appointment->id)
                ->value('reference_number');
            if ($referencecode) {
                Mail::to($data['email'])->send(new Sendrefund($referencecode));
            }
            return redirect()->route('welcomepatient')->with('success', 'Appointment cancelled successfully.');
        }
        
        // For psychometricians
        if ($user->role == 'psychometrician') {
            return redirect()->route('appointment.viewconfirmed')->with('success', 'Appointment cancelled successfully.');
        }
        
        // For admin
        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
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

    public function details($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        
        $appointment = Appointment::findOrFail($id);
        
        // Security check - only allow viewing own appointments
        if ($user->role == 'patient' && $appointment->user_id != $user->id) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access']);
        }
        
        // Get psychometrician info
        if ($appointment->psychometrician_id) {
            $psychometrician = Users::find($appointment->psychometrician_id);
            $appointment->psychometrician = $psychometrician;
        } else {
            $appointment->psychometrician = null;
        }
        
        return view('include/header')
            .view('include/navbar')
            .view('appointment.details', compact('appointment'));
    }
}























