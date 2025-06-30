<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concerns;

class ConcernsController extends Controller
{
    public function patientconcerns()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'helpdesk') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $concerns = Concerns::all();

        return view('include/headerhelpdesk')
            .view('include/navbarhelpdesk')
            .view('concerns/patientconcerns', ['concerns' => $concerns]);
    }

    public function show($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'helpdesk') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $concern = Concerns::findOrFail($id);

        return view('include/headerhelpdesk')
            .view('include/navbarhelpdesk')
            .view('concerns/patientconcernview', ['concern' => $concern]);
    }

    public function reply($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'helpdesk') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $concern = Concerns::findOrFail($id);

        return view('include/headerhelpdesk')
            .view('include/navbarhelpdesk')
            .view('concerns.reply', ['concern' => $concern]);
    }

    public function send(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not logged in']);
        }
        if ($user->role !== 'helpdesk') {
            return redirect()->route('login')->withErrors(['user' => 'Unauthorized access']);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Concerns::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
        ]);

        return redirect()->route('welcome')->with('success', 'Your concern has been sent successfully.');
    }
}
