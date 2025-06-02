<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function usersview()
    {
        
        $usersmodel = \App\Models\Users::where('disable', false);

        //$data['users'] = $usersmodel->get()->getResult();
        $users = $usersmodel->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersview', compact('users'));
    }

    public function usersadd()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['name', 'username', 'email', 'role', 'contactnumber']);
            $data['password'] = "123"; // Default password, should be changed later
            $data['status'] = '1'; // Default status, activated

            // Validate the data here if needed

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
            $data = request()->only(['name', 'username', 'email', 'role', 'contactnumber']);
            // Update the user data
            $user->update($data);

            return redirect()->route('users.view')->with('success', 'User updated successfully.');
        }

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersedit', compact('user'));
    }

    public function usersidview($id)
    {
        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersidview', compact('user'));
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

    public function usersarchive()
    {
        $usersmodel = \App\Models\Users::where('disable', true);

        $users = $usersmodel->paginate(10);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersarchive', compact('users'));
    }

    public function usersidviewdisabled($id)
    {
        $usersmodel = \App\Models\Users::where('disable', true);
        $user = $usersmodel->find($id);

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersidviewdisabled', compact('user'));
    }
}
