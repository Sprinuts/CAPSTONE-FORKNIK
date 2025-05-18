<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function login()
    {
        if (request()->isMethod('post')) {
            $usersmodel = new \App\Models\Users();

            $credentials = request()->only(['username', 'password']);

            $user = $usersmodel->where('username', $credentials['username'])
                                ->where('password', $credentials['password'])
                                ->first();
            
            if ($user) {
                // Assuming you have a session or authentication system in place
                //session(['user' => $user]); uncomment later
                return redirect()->route('welcome'); // Redirect to the dashboard or home page
            } else {
                return back()->withErrors(['Invalid credentials']);
            }


        }
        return view('login');
    }

    public function register()
    {
        if (request()->isMethod('post')) {
            $usersmodel = new \App\Models\Users();

            $data = request()->only(['name', 'password', 'email', 'username']);
            $data['role'] = 'patient'; 

            // Validate the data here if needed

            $usersmodel->create($data);

            return redirect()->route('welcome'); // Redirect to the welcome page or login page
        }
        return view('login');
    }
}
