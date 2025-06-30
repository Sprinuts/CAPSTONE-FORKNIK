<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Appointment;
use App\Models\Assessment;

class AdminController extends Controller
{
    public function refreshStats()
    {
        // Check if user is logged in and is admin
        $user = session('user');
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get current month and previous month dates
        $currentMonthStart = now()->startOfMonth();
        $previousMonthStart = now()->subMonth()->startOfMonth();
        $previousMonthEnd = now()->subMonth()->endOfMonth();

        // Get total users and calculate change
        $totalUsers = Users::where('status', 1)->count();
        $lastMonthUsers = Users::where('status', 1)
            ->where('created_at', '<', $currentMonthStart)
            ->count();
        $userChange = $lastMonthUsers > 0 
            ? round((($totalUsers - $lastMonthUsers) / $lastMonthUsers) * 100) 
            : 0;

        // Get total appointments and calculate change
        $totalAppointments = Appointment::where('cancelled', false)->count();
        $currentMonthAppointments = Appointment::where('cancelled', false)
            ->where('created_at', '>=', $currentMonthStart)
            ->count();
        $previousMonthAppointments = Appointment::where('cancelled', false)
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $appointmentChange = $previousMonthAppointments > 0 
            ? round((($currentMonthAppointments - $previousMonthAppointments) / $previousMonthAppointments) * 100) 
            : ($currentMonthAppointments > 0 ? 100 : 0);

        // Get total psychometricians and calculate change
        $totalPsychometricians = Users::where('role', 'psychometrician')->where('status', 1)->count();
        $currentMonthPsychometricians = Users::where('role', 'psychometrician')
            ->where('status', 1)
            ->where('created_at', '>=', $currentMonthStart)
            ->count();
        $previousMonthPsychometricians = Users::where('role', 'psychometrician')
            ->where('status', 1)
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $psychometricianChange = $previousMonthPsychometricians > 0 
            ? round((($currentMonthPsychometricians - $previousMonthPsychometricians) / $previousMonthPsychometricians) * 100) 
            : ($currentMonthPsychometricians > 0 ? 100 : 0);

        return response()->json([
            'totalUsers' => $totalUsers,
            'userChange' => $userChange,
            'totalAppointments' => $totalAppointments,
            'appointmentChange' => $appointmentChange,
            'totalPsychometricians' => $totalPsychometricians,
            'psychometricianChange' => $psychometricianChange,
        ]);
    }

    public function refreshActivities()
    {
        // Check if user is logged in and is admin
        $user = session('user');
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Return mock activities since the table doesn't exist
        $activities = [
            [
                'id' => 1,
                'description' => 'System generated monthly report',
                'type' => 'system',
                'icon' => 'chart-bar',
                'time_ago' => now()->subHours(2)->diffForHumans(),
                'user' => null
            ],
            [
                'id' => 2,
                'description' => 'New user registered',
                'type' => 'register',
                'icon' => 'user-plus',
                'time_ago' => now()->subHours(5)->diffForHumans(),
                'user' => null
            ],
            [
                'id' => 3,
                'description' => 'Appointment scheduled',
                'type' => 'appointment',
                'icon' => 'calendar-check',
                'time_ago' => now()->subHours(8)->diffForHumans(),
                'user' => null
            ]
        ];

        return response()->json([
            'activities' => $activities
        ]);
    }
}


