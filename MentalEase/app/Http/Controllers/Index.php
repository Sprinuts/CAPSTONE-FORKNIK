<?php

namespace App\Http\Controllers;
use App\Mail\Sendactivationcode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;



class Index extends Controller
{
    public function login()
    {
        $user = session('user');
        if ($user) {
            switch ($user->role) {
                case 'patient':
                    return redirect()->route('welcomepatient');
                case 'psychometrician':
                    return redirect()->route('welcomepsychometrician');
                case 'admin':
                    return redirect()->route('welcomeadmin');
                case 'cashier':
                    return redirect()->route('welcomecashier');
                case 'helpdesk':
                    return redirect()->route('welcomehelpdesk');
                default:
                    // Optionally handle unknown roles
                    break;
            }
        }

        if (request()->isMethod('post')) {

            $data = request()->only(['username', 'password']);
            
            $messages = [
                'username.required' => 'Please enter your username.',
                'username.string' => 'Username is wrong.',
                'username.alpha_num' => 'Username is wrong.',
                'username.min' => 'Username is wrong.',
                'username.max' => 'Username is wrong.',
                'password.required' => 'Please enter your password.',
                'password.string' => 'Password is wrong.',
                'password.min' => 'Password is wrong.',
            ];

            $validatedData = request()->validate([
                'username' => [
                    'required',
                    'string',
                    'alpha_num',
                    'min:3',
                    'max:50',
                    'regex:/^[A-Za-z0-9_]+$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/^[^<>\'"]+$/'
                ],
            ], $messages);

            $usersmodel = new \App\Models\Users();
            $user = $usersmodel->where('username', $validatedData['username'])->first();

            if (!$user) {
                return back()->withErrors(['login' => 'Invalid username or password']);
            }

            if ($user->verifyPassword($data['password'])) {
                if ($user->disable) {
                    return back()->withErrors(['login' => 'Your account has been disabled. Please contact support.']);
                } else {
                    if ($user->status == true && $user->has_completed_profile == true) { // Check if the account is activated and profile is complete
                        session(['user' => $user]);
                        
                        // Log login activity
                        \App\Models\Logs::create([
                            'name' => $user->username,
                            'log' => ' logged in to the system',
                            'type' => 'login'
                        ]);
                        
                        switch ($user->role) {
                            case 'patient':
                                return redirect()->route('welcomepatient'); // Redirect to welcome page
                            case 'admin':
                                return redirect()->route('welcomeadmin'); // Redirect to admin dashboard
                            case 'psychometrician':
                                return redirect()->route('welcomepsychometrician'); // Redirect to psychometrician dashboard
                            case 'cashier':
                                return redirect()->route('welcomecashier'); // Redirect to cashier dashboard
                            case 'helpdesk':
                                return redirect()->route('welcomehelpdesk'); // Redirect to helpdesk dashboard
                            default:
                                return back()->withErrors(['login' => 'Unknown user role.']);
                        }
                        
                    } else if (!$user->has_completed_profile) {
                        session(['user' => $user]);
                        return redirect()->route('profile.complete'); // Redirect to profile completion page
                    } else {
                        return redirect()->route('activate', [$data['username']]);
                    }
                }
            } else {
                return back()->withErrors(['login' => 'Invalid username or password']);
            }
        }
        return view('usercredentials/login');
    }

    public function register()
    {
        $user = session('user');
        if ($user) {
            switch ($user->role) {
                case 'patient':
                    return redirect()->route('welcomepatient');
                case 'psychometrician':
                    return redirect()->route('welcomepsychometrician');
                case 'admin':
                    return redirect()->route('welcomeadmin');
                case 'cashier':
                    return redirect()->route('welcomecashier');
                case 'helpdesk':
                    return redirect()->route('welcomehelpdesk');
                default:
                    // Optionally handle unknown roles
                    break;
            }
        }

        if (request()->isMethod('post')) {
            $activationcode = rand(100000, 999999);

            $usersmodel = new \App\Models\Users();

            // Validate the data
            $validatedData = request()->validate([
                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                    'max:255',
                    'regex:/^[^<>\'"]+$/'
                ],
                'username' => [
                    'required',
                    'string',
                    'min:3',
                    'max:50',
                    'unique:users,username',
                    'alpha_num',
                    'regex:/^[A-Za-z0-9_]+$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    'regex:/^[^<>\'"]+$/'
                ],
            ]);

            $data = $validatedData;
            $data['role'] = 'patient';
            $data['activationcode'] = $activationcode;
            $data['password'] = Hash::make($data['password']);

            $user = $usersmodel->create($data);

            // Log registration activity
            \App\Helpers\ActivityLogger::log(
                'New user registered with username ' . $data['username'],
                'register',
                'user-plus'
            );

            try {
                Mail::to($data['email'])->send(new Sendactivationcode($activationcode));
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                \Log::error('Mail sending failed: ' . $e->getMessage());
                // Optionally, you can show a user-friendly message or continue without failing
            }

            return redirect()->route('activate', [$data['username']]); // redirect to activation page
        }
        return view('usercredentials/register');
    }

    public function welcomepatient()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }
        $appointments = [];

        if ($user) {
            // Get appointments for the user
            $appointments = \App\Models\Appointment::where('user_id', $user->id)
                ->where('complete', false)
                ->where('cancelled', false)
                ->get();

            // For each appointment, get the psychometrician info
            foreach ($appointments as $appointment) {
                if ($appointment->psychometrician_id) {
                    $psychometrician = \App\Models\Users::find($appointment->psychometrician_id);
                    $appointment->psychometrician = $psychometrician;
                } else {
                    $appointment->psychometrician = null;
                }
            }
        }

        return view('include/header')
            .view('include/navbar')
            .view('welcomepatient', ['appointments' => $appointments])
            .view('include/footer');
    }

    public function welcomeadmin()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        // Get current month and previous month dates
        $currentMonthStart = now()->startOfMonth();
        $previousMonthStart = now()->subMonth()->startOfMonth();
        $previousMonthEnd = now()->subMonth()->endOfMonth();

        // Get total users and calculate change
        $totalUsers = \App\Models\Users::where('status', 1)->count();
        $lastMonthUsers = \App\Models\Users::where('status', 1)
            ->where('created_at', '<', $currentMonthStart)
            ->count();
        $userChange = $lastMonthUsers > 0 
            ? round((($totalUsers - $lastMonthUsers) / $lastMonthUsers) * 100) 
            : 0;

        // Get total appointments and calculate change
        $totalAppointments = \App\Models\Appointment::where('cancelled', false)->count();
        $currentMonthAppointments = \App\Models\Appointment::where('cancelled', false)
            ->where('created_at', '>=', $currentMonthStart)
            ->count();
        $previousMonthAppointments = \App\Models\Appointment::where('cancelled', false)
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $appointmentChange = $previousMonthAppointments > 0 
            ? round((($currentMonthAppointments - $previousMonthAppointments) / $previousMonthAppointments) * 100) 
            : ($currentMonthAppointments > 0 ? 100 : 0);

        // Get total psychometricians and calculate change
        $totalPsychometricians = \App\Models\Users::where('role', 'psychometrician')->where('status', 1)->count();
        $currentMonthPsychometricians = \App\Models\Users::where('role', 'psychometrician')
            ->where('status', 1)
            ->where('created_at', '>=', $currentMonthStart)
            ->count();
        $previousMonthPsychometricians = \App\Models\Users::where('role', 'psychometrician')
            ->where('status', 1)
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $psychometricianChange = $previousMonthPsychometricians > 0 
            ? round((($currentMonthPsychometricians - $previousMonthPsychometricians) / $previousMonthPsychometricians) * 100) 
            : ($currentMonthPsychometricians > 0 ? 100 : 0);

        // Get the 10 most recent logs
        $recentActivities = \App\Models\Logs::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();


        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('welcome/welcomeadmin', [
                'totalUsers' => $totalUsers,
                'userChange' => $userChange,
                'totalAppointments' => $totalAppointments,
                'appointmentChange' => $appointmentChange,
                'totalPsychometricians' => $totalPsychometricians,
                'psychometricianChange' => $psychometricianChange,
                'recentActivities' => $recentActivities,
            ]);
            // .view('include/footeradmin');
    }

    public function welcomepsychometrician()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('welcome/welcomepsychometrician');
            // .view('include/footeradmin');

    }

    public function welcomecashier()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'cashier') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        // Get today's date
        $today = now()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        
        // Calculate today's revenue
        $todayRevenue = \App\Models\Invoice::whereDate('created_at', $today)
            ->sum('amount');
        
        // Count today's transactions
        $todayTransactions = \App\Models\Invoice::whereDate('created_at', $today)
            ->count();
        
        // Calculate weekly revenue
        $weeklyRevenue = \App\Models\Invoice::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('amount');
        
        // Count pending payments and calculate pending amount
        $pendingPayments = \App\Models\Invoice::where('payment_status', 'pending')
            ->count();
        $pendingAmount = \App\Models\Invoice::where('payment_status', 'pending')
            ->sum('amount');
        
        // Get recent transactions
        $recentTransactions = \App\Models\Invoice::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($invoice) {
                return (object) [
                    'id' => $invoice->id,
                    'patient_name' => $invoice->client ? $invoice->client->name : 'Unknown Patient',
                    'service_type' => $invoice->service_type ?? 'Consultation',
                    'amount' => $invoice->amount,
                    'payment_method' => $invoice->payment_method ?? 'Online',
                    'created_at' => $invoice->created_at
                ];
            });
        
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('welcome/welcomecashier', compact(
                'todayRevenue',
                'todayTransactions',
                'weeklyRevenue',
                'pendingPayments',
                'pendingAmount',
                'recentTransactions'
            ));
    }

    public function logout()
    {
        $user = session('user');
        
        if ($user) {
            // Log logout activity
            \App\Helpers\ActivityLogger::log(
                $user->name . ' logged out of the system',
                'logout',
                'sign-out-alt',
                $user->id
            );
        }
        
        // Clear the user session
        session()->forget('user');
        session()->flush();
        
        // Return with cache control headers to prevent back button access
        return redirect()->route('login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    public function about()
    {
        return view('about');
    }

    public function appointment()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }
        
        return view('include/header')
            .view('include/navbar')
            .view('appointment')
            .view('include/footer');
    }

    public function consultation()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        return view('include/header')
            .view('include/navbar')
            .view('consult/consultation');
    }

    public function consultationpsychometrician()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'psychometrician') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('consult/consultationpsychometrician');
    }

    public function myrecords()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }
        // This method should return the user's records.
        // For now, it returns a temporary view.
        // You can replace this with actual logic to fetch user records.
        return view('include/header')
            .view('include/navbar')
            .view('patientrecord/record')
            .view('include/footer'); // temporary
    }

    public function journal()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }
        
        $user = session('user');
        $journals = [];

        if ($user) {
            $journals = \App\Models\Journal::where('user_id', $user->id)->get();
        }

        return view('include/header')
            .view('include/navbar')
            .view('journal/journal', ['journals' => $journals])
            .view('include/footer');
    }

    public function welcome()
    {
        $user = session('user');
        if ($user) {
            switch ($user->role) {
                case 'patient':
                    return redirect()->route('welcomepatient');
                case 'psychometrician':
                    return redirect()->route('welcomepsychometrician');
                case 'admin':
                    return redirect()->route('welcomeadmin');
                case 'cashier':
                    return redirect()->route('welcomecashier');
                default:
                    // Optionally handle unknown roles
                    break;
            }
        }

        return view('welcome');
    }

    /**
     * Automatically log out users with incomplete profiles when they close the browser
     */
    public function autoLogout()
    {
        $user = session('user');
        
        if ($user && !$user->has_completed_profile) {
            // Log auto-logout activity
            \App\Helpers\ActivityLogger::log(
                $user->name . ' was automatically logged out (incomplete profile)',
                'auto-logout',
                'sign-out-alt',
                $user->id
            );
            
            // Clear the user session
            session()->forget('user');
            session()->flush();
        }
        
        // Return a 204 No Content response
        return response()->noContent();
    }

    public function welcomehelpdesk()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'helpdesk') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        return view('include/headerhelpdesk')
            .view('include/navbarhelpdesk')
            .view('welcome/welcomehelpdesk');
    }

    public function concerns()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        return view('include/header')
            .view('include/navbar')
            .view('concerns/concern')
            .view('include/footer');
    }
}












