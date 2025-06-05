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

            $usersmodel = new \App\Models\Users();
            $user = $usersmodel->where('username', $data['username'])
                ->where('password', $data['password'])
                ->first();

            if ($user->disable) {
                return back()->withErrors(['login' => 'Your account has been disabled. Please contact support.']);
            } else {
                if ($user) {
                    if ($user->status == '1') { // Check if the account is activated
                        session(['user' => $user]);
                        if ($user->role == 'patient'){
                            return redirect()->route('welcomepatient'); // Redirect to welcome page
                        } else if ($user->role == 'admin'){
                            return redirect()->route('welcomeadmin'); // Redirect to admin dashboard
                        } else if ($user->role == 'psychometrician'){
                            return redirect()->route('welcomepsychometrician'); // Redirect to psychometrician dashboard
                        }
                    } else {
                        return redirect()->route('activate', [$data['username']]);
                    }
                } else {
                    return back()->withErrors(['login' => 'Invalid username or password']);
                }
            }
        }
        return view('usercredentials/login');
    }

    public function register()
    {
        if (request()->isMethod('post')) {
            $activationcode = rand(100000, 999999);

            $usersmodel = new \App\Models\Users();

            //put here validation of data

            $data = request()->only(['name', 'password', 'email', 'username']);
            $data['role'] = 'patient';
            $data['activationcode'] = $activationcode;

            // Validate the data here if needed

            $usersmodel->create($data);

            Mail::to($data['email'])->send(new Sendactivationcode($activationcode));

            return redirect()->route('activate', [$data['username']]); // redirect to activation page
        }
        return view('usercredentials/login');
    }

    public function welcomepatient()
    {

        return view('include/header')
            .view('include/navbar')
            .view('welcomepatient');
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
            .view('appointment');
    }

    public function consultation()
    {
        return view('include/header')
            .view('include/navbar')
            .view('consult/consultation'); // temporary
    }

    public function myrecords()
    {
        // This method should return the user's records.
        // For now, it returns a temporary view.
        // You can replace this with actual logic to fetch user records.
        return view('include/header')
            .view('include/navbar')
            .view('patientrecord/record'); // temporary
    }
}
