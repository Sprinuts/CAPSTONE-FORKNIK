<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users extends Controller
{
    public function activate()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['username', 'activationcode']);

            $username = request()->input('username');

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
        return view('usercredentials/activateaccount');
    }
}
