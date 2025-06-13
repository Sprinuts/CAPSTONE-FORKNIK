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
            .view('schedule.create', compact('psychometrician', 'schedules'));
    }

    public function store(Request $request)
    {
        // Check if we're creating multiple appointments
        if ($request->has('appointments')) {
            foreach ($request->appointments as $appointment) {
                Schedule::create([
                    'psychometrician_id' => $request->psychometrician_id,
                    'date' => $appointment['date'],
                    'start_time' => $appointment['start_time'],
                    'end_time' => \Carbon\Carbon::parse($appointment['start_time'])->addHour(),
                ]);
            }
            
            return redirect()->back()->with('success', 'Multiple schedules added successfully.');
        } else {
            // Original single appointment logic
            Schedule::create([
                'psychometrician_id' => $request->psychometrician_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => \Carbon\Carbon::parse($request->start_time)->addHour(),
            ]);
            
            return redirect()->back()->with('success', 'Schedule added.');
        }
    }

    public function view()
    {
        $psychometrician = session('user');
        $schedules = Schedule::where('psychometrician_id', $psychometrician->id)->get();

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('schedule/scheduleview', compact('schedules', 'psychometrician'));
    }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->query('date');
        $psychometricianId = $request->query('psychometrician_id');
        $currentScheduleId = $request->query('schedule_id', null);

        // Get all schedules for this date and psychometrician
        $schedulesQuery = Schedule::where('psychometrician_id', $psychometricianId)
            ->where('date', $date);
        
        // If we're editing a schedule, exclude it from the query
        if ($currentScheduleId) {
            $schedulesQuery->where('id', '!=', $currentScheduleId);
        }
        
        // Get all booked times (both scheduled and unscheduled slots)
        $booked = $schedulesQuery->pluck('start_time')
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

        // Available times are all slots minus booked ones
        $available = array_diff($allSlots, $booked);

        return response()->json([
            'available_times' => array_values($available),
            'booked_times' => $booked
        ]);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $psychometrician = session('user');
        
        // Check if the schedule belongs to the logged-in psychometrician
        if ($schedule->psychometrician_id != $psychometrician->id) {
            return redirect()->route('schedule.view')->with('error', 'You are not authorized to delete this schedule.');
        }
        
        // Check if the schedule is already booked
        if ($schedule->scheduled) {
            return redirect()->route('schedule.view')->with('error', 'Cannot delete a scheduled appointment.');
        }
        
        // Delete the schedule
        $schedule->delete();
        
        return redirect()->route('schedule.view')->with('success', 'Schedule deleted successfully.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $psychometrician = session('user');
        
        // Check if the schedule belongs to the logged-in psychometrician
        if ($schedule->psychometrician_id != $psychometrician->id) {
            return redirect()->route('schedule.view')->with('error', 'You are not authorized to edit this schedule.');
        }
        
        // Check if the schedule is already booked
        if ($schedule->scheduled) {
            return redirect()->route('schedule.view')->with('error', 'Cannot edit a scheduled appointment.');
        }
        
        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $psychometrician = session('user');
        
        // Check if the schedule belongs to the logged-in psychometrician
        if ($schedule->psychometrician_id != $psychometrician->id) {
            return redirect()->route('schedule.view')->with('error', 'You are not authorized to update this schedule.');
        }
        
        // Check if the schedule is already booked
        if ($schedule->scheduled) {
            return redirect()->route('schedule.view')->with('error', 'Cannot update a scheduled appointment.');
        }
        
        // Update the schedule
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = \Carbon\Carbon::parse($request->start_time)->addHour();
        $schedule->save();
        
        return redirect()->route('schedule.view')->with('success', 'Schedule updated successfully.');
    }
}





