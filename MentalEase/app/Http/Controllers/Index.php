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

            if ($user) {
                if ($user->status == '1') { // Check if the account is activated
                    session(['user' => $user]);
                    return redirect()->route('welcomepatient'); // Redirect to welcome page
                } else {
                    return redirect()->route('activate', [$data['username']]);
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
