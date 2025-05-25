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

            $credentials = request()->only(['username', 'password']);

            $user = \App\Models\Users::where('username', $credentials['username'])->first();

            if ($user) {
                // Assuming you have a session or authentication system in place
                //session(['user' => $user]); uncomment later

                if (Hash::check($credentials['password'], $user->password)) {
                    // Password is correct
                    // Set session or authentication state here
                    // session(['user' => $user]); // Store user in session

                    if ($user->role === 'patient') {
                    return redirect()->route('welcomepatient');
                    }
                    return redirect()->route('welcome');// Redirect to the dashboard or home page
                } else {
                    return back()->withErrors(['password' => 'Invalid credentials']);
                }
            } else {
                return back()->withErrors(['username' => 'Invalid credentials']);
            }


        }
        return view('usercredentials/login');
    }

    public function register()
    {
        if (request()->isMethod('post')) {
            $activationcode = rand(100000, 999999);

            $usersmodel = new \App\Models\Users();

            $data = request()->only(['name', bcrypt('password'), 'email', 'username']);
            $data['role'] = 'patient';
            $data['activationcode'] = $activationcode;

            // Validate the data here if needed

            $usersmodel->create($data);

            Mail::to($data['email'])->send(new Sendactivationcode($activationcode));

            return redirect()->route('activate'); // redirect to activation page
        }
        return view('usercredentials/login');
    }

    public function welcomepatient()
    {

        return view('include/header')
            .view('include/navbar')
            .view('welcomepatient');
    }

    public function logout()
    {

        //session()->destroy(); uncomment later
        return redirect()->route('usercredentials/login');
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
}
