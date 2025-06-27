<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class Users extends Controller
{
    public function activate(Request $request, $username)
    {
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
        
        
        $usersmodel = new \App\Models\Users();

        //$data['users'] = $usersmodel->get()->getResult();
        $users = $usersmodel->where('disable', 0)->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersview', compact('users'));
    }

    public function usersadd()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['username', 'email', 'role']);
            $data['password'] = bcrypt('123'); // Default hashed password, should be changed later
            $data['status'] = '1'; // Default status, activated

            // Validate the data here if needed
            $validateData = request()->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'role' => 'required|string|max:50',
            ]);

            $usersmodel = new \App\Models\Users();
            $usersmodel->create($data);

            return redirect()->route('users.view')->with('success', 'User added successfully.');
        }
        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersadd');
    }

    public function usersedit($id)
    {
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
        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);



        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersdelete', compact('user'));
    }   

    public function usersdisable($id)
    {
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
        $usersmodel = new \App\Models\Users();
        $users = $usersmodel->where('disable', '1')->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersarchive', compact('users'));
    }

    public function usersidview($id)
    {
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
                'religion' => 'required|string|max:255',
                'terms_agree' => 'required',
            ], [
                'terms_agree.required' => 'You must agree to the Terms and Conditions to continue.'
            ]);

            // Update user data
            $data = $request->only([
                'name', 'middle_name', 'last_name', 'contactnumber', 
                'address', 'gender', 'civil_status', 'birthdate', 
                'birthplace', 'religion'
            ]);

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

        $appointments = \App\Models\Appointment::where('user_id', $sessionUser->id)
            ->where('complete', true)
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
}










