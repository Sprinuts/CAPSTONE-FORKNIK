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

                    return redirect()->route('login')->with('success', 'Account activated successfully. You can now log in.');
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
            $data['password'] = "123"; // Default password, should be changed later
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
            // Only update fields that are provided
            if ($request->filled('name')) {
                $user->name = $request->name;
            }
            
            if ($request->filled('email')) {
                $user->email = $request->email;
            }
            
            if ($request->filled('contactnumber')) {
                $user->contactnumber = $request->contactnumber;
            }
            
            // Handle password change if provided
            if ($request->filled('password') && $request->filled('password_confirmation')) {
                if ($request->password === $request->password_confirmation) {
                    $user->password = $request->password;
                } else {
                    return redirect()->back()->withErrors(['password' => 'Passwords do not match']);
                }
            }
            
            $user->save();
            
            // Update session data
            session(['user' => $user]);
            
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        }
        
        return redirect()->back()->withErrors(['user' => 'User not found']);
    }

    public function generatePdf()
    {
        $usersmodel = new \App\Models\Users();
        $users = $usersmodel->where('disable', 0)->get();

        $pdf = Pdf::loadView('users/userspdf', compact('users'));

        return $pdf->download('users.pdf');
    }

    public function profilecomplete()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }

        if (request()->isMethod('post')) {
            $data = request()->validate([
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
            ]);

            if (isset($data['birthdate'])) {
                $birthdate = new \DateTime($data['birthdate']);
                $today = new \DateTime();
                $age = $today->diff($birthdate)->y;
                $data['age'] = $age;
            }

            $user->update($data);

            $user->has_completed_profile = true; // Mark profile as complete
            $user->save();

            // Update session data
            session(['user' => $user]);

            // Redirect to welcomepatient instead of profile
            return redirect()->route('welcomepatient')->with('success', 'Profile completed successfully');
        }

        return view('include/header')
            .view('usercredentials/profilecomplete');
    }
}




