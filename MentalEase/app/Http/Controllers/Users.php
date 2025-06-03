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
        
        $usersmodel = new \App\Models\Users();

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

            return redirect()->route('usersview')->with('success', 'User added successfully.');
        }
        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('users/usersadd');
    }

    public function usersedit($id)
    {
        $usersmodel = new \App\Models\Users();
        $user = $usersmodel->find($id);



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
}
