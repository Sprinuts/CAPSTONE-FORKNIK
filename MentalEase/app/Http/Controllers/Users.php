<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class Users extends Controller
{
    public function activate(Request $request, $username)
    {
        $user = session('user');    
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        if ($request->isMethod('post')) {
            $data = $request->only(['activationcode']);

            $user = \App\Models\Users::where('username', $username)->first();

            if ($user) {
                if ($user->activationcode == $data['activationcode']) {
                    $user->status = '1';
                    $user->save();

                    // Store user in session
                    session(['user' => $user]);
                    
                    // Redirect to profile completion page instead of login
                    return redirect()->route('profile.complete')->with('success', 'Account activated successfully. Please complete your profile.');
                } else {
                    return back()->withErrors(['activationcode' => 'Invalid activation code']);
                }
            } else {
                return back()->withErrors(['username' => 'User not found']);
            }
        }

        // Pass the username to the view
        return view('usercredentials/activateaccount', compact('username'));
    }
//test test test
    public function usersview()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }
        
        $usersmodel = new \App\Models\Users();

        //$data['users'] = $usersmodel->get()->getResult();
        $users = $usersmodel->where('disable', 0)->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersview', compact('users'));
    }

    public function usersadd(Request $request)
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($sessionUser->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'role' => 'required|string|max:50',
            ]);

            $validated['password'] = bcrypt($validated['username'] . '123456'); // Default password is username123456
            $validated['status'] = '1'; // Activated

            \App\Models\Users::create($validated);

            return redirect()->route('users.view')->with('success', 'User added successfully.');
        }

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersadd');
    }

    public function usersedit($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        if (request()->isMethod('post')) {
            $data = request()->only(['username', 'email', 'role']);
            // Update the user with the provided data
            $user->update($data);

            return redirect()->route('users.view')->with('success', 'User updated successfully.');
        }

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersedit', compact('user'));
    }

    public function usersupdate($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);



        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersdelete', compact('user'));
    }   

    public function usersdisable($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        if ($user) {
            $user->disable = '1'; // Disable the user
            $user->save();

            return redirect()->route('users.view')->with('success', 'User disabled successfully.');
        }

        return redirect()->route('users.view')->withErrors(['user' => 'User not found']);
    }

    public function usersenable($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        if ($user) {
            $user->disable = '0'; // Enable the user
            $user->save();

            return redirect()->route('users.archive')->with('success', 'User enabled successfully.');
        }

        return redirect()->route('users.archive')->withErrors(['user' => 'User not found']);
    }

    public function usersarchive()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $users = $usersmodel->where('disable', '1')->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersarchive', compact('users'));
    }

    public function usersidview($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        if ($user) {
            return view('include/headeradmin')
                .view('include/navbaradmin')
                .view('users/usersidview', compact('user'));
        }

        return redirect()->route('users.view')->withErrors(['user' => 'User not found']);
    }

    public function usersidviewdisabled($id)
    {

        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        if ($user) {
            return view('include/headeradmin')
                .view('include/navbaradmin')
                .view('users/usersidviewdisabled', compact('user'));
        }

        return redirect()->route('users.archive')->withErrors(['user' => 'User not found']);
    }

    public function profile()
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        if ($sessionUser->role !== 'patient') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $user = \App\Models\Users::find($sessionUser->id);

        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not found']);
        }

        return view('include/header')
            .view('include/navbar')
            .view('users/usersprofile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = \App\Models\Users::find(session('user')->id);
        
        if ($user) {
            // Update basic information
            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            if ($request->filled('middle_name')) {
                $user->middle_name = $request->middle_name;
            }

            if ($request->filled('last_name')) {
                $user->last_name = $request->last_name;
            }

            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            if ($request->filled('contactnumber')) {
                $user->contactnumber = $request->contactnumber;
            }

            if ($request->filled('address')) {
                $user->address = $request->address;
            }

            if ($request->filled('gender')) {
                $user->gender = $request->gender;
            }

            if ($request->filled('birthdate')) {
                $user->birthdate = $request->birthdate;
                
                // Calculate age based on birthdate
                if ($request->birthdate) {
                    $birthdate = new \DateTime($request->birthdate);
                    $today = new \DateTime();
                    $age = $birthdate->diff($today)->y;
                    $user->age = $age;
                }
            }

            if ($request->filled('birthplace')) {
                $user->birthplace = $request->birthplace;
            }
            
            if ($request->filled('civil_status')) {
                $user->civil_status = $request->civil_status;
            }
            
            if ($request->filled('religion')) {
                $user->religion = $request->religion;
            }
            
            // Handle password change if provided
            if ($request->filled('current_password') && $request->filled('password') && $request->filled('password_confirmation')) {
                // Verify current password
                if (password_verify($request->current_password, $user->password)) {
                    if ($request->password === $request->password_confirmation) {
                        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
                    } else {
                        return redirect()->back()->withErrors(['password' => 'New passwords do not match']);
                    }
                } else {
                    return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
                }
            }

            $user->save();

            // Update session data
            session(['user' => $user]);
            
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        }
        
        return redirect()->route('login')->withErrors(['user' => 'User not found']);
    }

    public function generatePdf()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $usersmodel = new \App\Models\Users();
        $users = $usersmodel->where('disable', 0)->get();

        $pdf = Pdf::loadView('users/userspdf', compact('users'));

        return $pdf->download('users.pdf');
    }

    public function profilecomplete(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        // If the user already completed their profile, redirect to appropriate page
        if ($user->has_completed_profile) {
            switch ($user->role) {
                case 'patient':
                    return redirect()->route('welcomepatient');
                case 'admin':
                    return redirect()->route('welcomeadmin');
                case 'psychometrician':
                    return redirect()->route('welcomepsychometrician');
                case 'cashier':
                    return redirect()->route('welcomecashier');
                default:
                    return redirect()->route('login');
            }
        }

        if ($request->isMethod('post')) {
            // Validate the form data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'contactnumber' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'gender' => 'required|string|in:Male,Female,Other',
                'civil_status' => 'required|string|in:Single,Married,Widowed,Divorced',
                'birthdate' => 'required|date',
                'birthplace' => 'required|string|max:255',
                'religion' => 'nullable|string|max:255',
                'terms_agree' => 'required',
            ], [
                'terms_agree.required' => 'You must agree to the Terms and Conditions to continue.'
            ]);

            // Update user data
            $data = $validatedData;
            unset($data['terms_agree']); // Remove terms_agree as it's not a user field
            
            // Update the user with the validated data
            $user->update($data);

            $user->has_completed_profile = true; // Mark profile as complete
            $user->save();

            // Update session data
            session(['user' => $user]);

            // Redirect to welcomepatient instead of profile
            switch ($user->role) {
                case 'patient':
                    return redirect()->route('welcomepatient')->with('success', 'Profile completed successfully');
                case 'admin':
                    return redirect()->route('welcomeadmin')->with('success', 'Profile completed successfully');
                case 'psychometrician':
                    return redirect()->route('welcomepsychometrician')->with('success', 'Profile completed successfully');
                case 'cashier':
                    return redirect()->route('welcomecashier')->with('success', 'Profile completed successfully');
                default:
                    return back()->withErrors(['login' => 'Unknown user role.']);
            }
        }

        return view('include/header')
            .view('usercredentials/profilecomplete');
    }

    public function editProfile()
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        $user = \App\Models\Users::find($sessionUser->id);

        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not found']);
        }

        return view('include/header')
            .view('include/navbar')
            .view('users/editprofile', compact('user'));
    }

    public function resendActivationCodeForm(Request $request, $username)
    {
        $user = \App\Models\Users::where('username', $username)->first();
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['username' => 'User not found']);
        }
        
        // Generate new activation code
        $newActivationCode = rand(100000, 999999);
        $user->activationcode = $newActivationCode;
        $user->save();
        
        // Send new activation code via email
        try {
            \Illuminate\Support\Facades\Mail::to($user->email)
                ->send(new \App\Mail\Sendactivationcode($newActivationCode));
            
            return redirect()->route('activate', [$username])
                ->with('success', 'A new activation code has been sent to your email address: ' . substr($user->email, 0, 3) . '***' . substr($user->email, strpos($user->email, '@')));
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->route('activate', [$username])
                ->withErrors(['email' => 'Failed to send activation code. Please try again later.']);
        }
    }

    public function patientappointmenthistory()
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        // Check for expired appointments first
        app('App\Http\Controllers\AppointmentController')->checkExpiredAppointments();

        $appointments = \App\Models\Appointment::where('user_id', $sessionUser->id)
            ->where(function($query) {
                $query->where('complete', true)
                    ->orWhere('cancelled', true);
            })
            ->get();

        // Get psychometrician info for each appointment
        foreach ($appointments as $appointment) {
            if ($appointment->psychometrician_id) {
                $appointment->psychometrician = \App\Models\Users::find($appointment->psychometrician_id);
            } else {
                $appointment->psychometrician = null;
            }
        }

        return view('include/header')
            .view('include/navbar')
            .view('appointment/patientappointmenthistory', compact('appointments'));
    }

    public function searchResults(Request $request)
    {
        $term = $request->input('term', '');
        $role = $request->input('role', 'all');
        
        // Query all users without pagination
        $query = \App\Models\Users::where('disable', 0);
        
        // Apply search term if provided
        if (!empty($term)) {
            $query->where(function($q) use ($term) {
                $q->where('username', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('name', 'like', "%{$term}%");
            });
        }
        
        // Apply role filter if not "all"
        if ($role !== 'all') {
            $query->where('role', $role);
        }
        
        // Get all matching users (no pagination)
        $users = $query->get();
        
        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/userssearch', compact('users', 'term', 'role'));
    }

    public function getTherapyHours($userId)
    {
        // Only count completed appointments that weren't cancelled
        $completedAppointments = \App\Models\Appointment::where('user_id', $userId)
            ->where('complete', true)
            ->where('cancelled', false)
            ->get();
        
        $totalHours = 0;
        
        foreach ($completedAppointments as $appointment) {
            // Calculate duration in hours (assuming each appointment is 1 hour)
            // If you have actual start and end times, you can calculate the difference
            $totalHours += 1; // Default to 1 hour per appointment
        }
        
        return $totalHours;
    }

    public function patientDashboardStats($userId)
    {
        // Check for expired appointments first
        app('App\Http\Controllers\AppointmentController')->checkExpiredAppointments();
        
        // Get total completed appointments (not cancelled)
        $completedSessions = \App\Models\Appointment::where('user_id', $userId)
            ->where('complete', true)
            ->where('cancelled', false)
            ->count();
        
        // Calculate therapy hours (only from completed, not cancelled appointments)
        $therapyHours = $this->getTherapyHours($userId);
        
        // Get upcoming appointments
        $upcomingAppointments = \App\Models\Appointment::where('user_id', $userId)
            ->where('complete', false)
            ->where('cancelled', false)
            ->where('date', '>=', \Carbon\Carbon::now()->toDateString())
            ->count();
        
        return [
            'completedSessions' => $completedSessions,
            'therapyHours' => $therapyHours,
            'upcomingAppointments' => $upcomingAppointments
        ];
    }

    public function passwordrequest()
    {
        // Show the password reset request form
        return view('usercredentials/passwordforgot');
    }

    public function passwordemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = \App\Models\Users::where('email', $request->email)->first();

        if ($user) {
            // Generate a token
            $resetcode = rand(100000, 999999);

            // Store token in user's resetcode field
            $user->resetcode = $resetcode;
            $user->save();

            try {
                \Illuminate\Support\Facades\Mail::to($user->email)
                    ->send(new \App\Mail\ResetPasswordMail($resetcode));

                return redirect()->route('password.resetcode', [
                    'username' => $user->username,
                    'email' => $user->email
                ])->with('status', 'Password reset link sent to your email.');
            } catch (\Exception $e) {
                \Log::error('Password reset email failed: ' . $e->getMessage());
                return back()->withErrors(['email' => 'Failed to send reset link. Please try again later.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }
    }

    public function passwordresetcode(Request $request)
    {
        $email = $request->query('email');

        $user = \App\Models\Users::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'User not found.']);
        }

        $username = $user->username;

        return view('usercredentials/passwordresetcode', compact('email', 'username'));
    }

    public function resetcode(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'resetcode' => 'required|digits:6',
        ]);

        $user = \App\Models\Users::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User not found.']);
        }

        // Compare the resetcode from the user and the request
        if ($user->resetcode != $request->resetcode) {
            return back()->withErrors(['resetcode' => 'Invalid reset code.']);
        }

        // Reset code is valid, redirect to password reset form
        return redirect()->route('resetpassword', ['username' => $user->username]);
    }

    public function resetpassword()
    {
        $username = request()->input('username');

        if (request()->isMethod('post')) {
            $request = request();

            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    'regex:/^[^<>\'"]+$/'
                ],
            ]);

            // Get username from session or query string
            $username = $request->input('username') ?? session('reset_username');
            if (!$username) {
                return redirect()->route('login')->withErrors(['username' => 'Session expired. Please try again.']);
            }

            $user = \App\Models\Users::where('username', $username)->first();
            if (!$user) {
                return redirect()->route('login')->withErrors(['username' => 'User not found.']);
            }

            $user->password = bcrypt($request->password);
            $user->resetcode = null; // Clear reset code after successful reset
            $user->save();

            return redirect()->route('login')->with('success', 'Password reset successfully. You can now log in.');
        }

        return view('usercredentials/resetpassword', compact('username'));
    }
}









