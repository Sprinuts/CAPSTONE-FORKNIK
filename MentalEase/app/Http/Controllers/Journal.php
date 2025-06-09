<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Journal extends Controller
{
    public function journalstore()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['mood', 'emotion', 'thoughts']);
            $data['user_id'] = session('user')->id; // Assuming user ID is stored in session

            // Validate the data here if needed

            $journalModel = new \App\Models\Journal();
            $journalModel->create($data);

            return redirect()->route('journal')->with('success', 'Journal entry created successfully.');
        }
    }

    public function journaladd()
    {
        return view('include/header')
            .view('include/navbar')
            .view('journal/journaladd');
    }
    
    public function journalshow($id)
    {
        $journalModel = new \App\Models\Journal();
        $journalEntry = $journalModel->find($id);

        if (!$journalEntry) {
            return redirect()->route('journal')->withErrors(['error' => 'Journal entry not found.']);
        }

        return view('include/header')
            .view('include/navbar')
            .view('journal/journalshow', compact('journalEntry'));
    }
}
