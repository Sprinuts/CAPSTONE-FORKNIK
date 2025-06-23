<?php

namespace App\Http\Controllers;
use App\Mail\SendActivationCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class Index extends Controller
{
    public function login()
    {
        if (request()->isMethod('post')) {

            $data = request()->only(['username', 'password']);

            // $messages = [
            //     'username.required' => 'Please enter your username.',
            //     'username.string' => 'Username is wrong.',
            //     'username.alpha_num' => 'Username is wrong.',
            //     'username.min' => 'Username is wrong.',
            //     'username.max' => 'Username is wrong.',
            //     'password.required' => 'Please enter your password.',
            //     'password.string' => 'Password is wrong.',
            //     'password.min' => 'Password is wrong.',
            // ];

            // $validatedData = $request->validate([
            //     'username' => 'required|string|alpha_num|min:3|max:50',
            //     'password' => 'required|string|min:6',
            // ], $messages);

            $usersmodel = new \App\Models\Users();
            $user = $usersmodel->where('username', $data['username'])
                ->where('password', $data['password'])
                ->first();

            if ($user) {
                if ($user->disable) {
                    return back()->withErrors(['login' => 'Your account has been disabled. Please contact support.']);
                } else {
                    if ($user->status == '1' && $user->has_completed_profile == true) { // Check if the account is activated and profile is complete
                        session(['user' => $user]);
                        if ($user->role == 'patient'){
                            return redirect()->route('welcomepatient'); // Redirect to welcome page
                        } else if ($user->role == 'admin'){
                            return redirect()->route('welcomeadmin'); // Redirect to admin dashboard
                        } else if ($user->role == 'psychometrician'){
                            return redirect()->route('welcomepsychometrician'); // Redirect to psychometrician dashboard
                        } else if ($user->role == 'cashier'){
                            return redirect()->route('welcomecashier'); // Redirect to cashier dashboard
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
        if (request()->isMethod('post')) {
            $activationcode = rand(100000, 999999);

            $usersmodel = new \App\Models\Users();

            // Validate the data
            $validatedData = request()->validate([
                'email' => 'required|email|unique:users,email|max:255',
                'username' => 'required|string|min:3|max:50|unique:users,username|alpha_num',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $data = request()->only(['name', 'password', 'email', 'username']);
            $data['role'] = 'patient';
            $data['activationcode'] = $activationcode;
            $data['password'] = Hash::make($data['password']);

            $usersmodel->create($data);

            Mail::to($data['email'])->send(new SendActivationCode($activationcode));

            return redirect()->route('activate', [$data['username']]); // redirect to activation page
        }
        return view('usercredentials/register');
    }

    public function welcomepatient()
    {
        $user = session('user');
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
        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('welcome/welcomeadmin');
    }

    public function welcomepsychometrician()
    {
        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('welcome/welcomepsychometrician');
    }

    public function welcomecashier()
    {
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('welcome/welcomecashier');
    }

    public function logout()
    {

        session()->forget('user');
        session()->flush();
        return redirect()->route('login');
    }

    public function about()
    {
        return view('include/header')
            .view('include/navbar')
            .view('about');
    }

    public function appointment()
    {
        return view('include/header')
            .view('include/navbar')
            .view('appointment')
            .view('include/footer');
    }

    public function consultation()
    {
        return view('include/header')
            .view('include/navbar')
            .view('consult/consultation');
    }

    public function consultationpsychometrician()
    {
        return view('include/headerpsychometrician')
            .view('include/navbarpsychometrician')
            .view('consult/consultationpsychometrician');
    }

    public function myrecords()
    {
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
        $journals = [];

        if ($user) {
            $journals = \App\Models\Journal::where('user_id', $user->id)->get();
        }

        return view('include/header')
            .view('include/navbar')
            .view('journal/journal', ['journals' => $journals])
            .view('include/footer');
    }
}

