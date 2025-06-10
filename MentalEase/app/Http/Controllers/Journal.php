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
            // $data['emotion'] = request()->input('emotion'); // Removed as it's now in only()

            // Validate the data here if needed
            $validator = \Illuminate\Support\Facades\Validator::make($data, [
                'mood' => 'nullable|string',
                'emotion' => 'nullable|string',
                'thoughts' => 'nullable|string',
                'gratitude' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $journalModel = new \App\Models\Journal();
            $journalModel->create($data);

            return redirect()->route('journal.list')->with('success', 'Journal entry created successfully.');
        }
    }

    public function journaladd()
    {
        return view('include/header')
            .view('include/navbar')
            .view('journal/journaladd')
            .view('include/footer');
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
            .view('journal/journalshow', compact('journalEntry'))
            .view('include/footer');
    }

    public function journallist()
    {
        $user = session('user');
        $journals = [];

        if ($user) {
            $journals = \App\Models\Journal::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('include/header')
            .view('include/navbar')
            .view('journal/journal-list', ['journals' => $journals])
            .view('include/footer');
    }

    public function journaldelete($id)
    {
        $journalModel = new \App\Models\Journal();
        $journalEntry = $journalModel->find($id);

        if (!$journalEntry) {
            return redirect()->route('journal.list')->withErrors(['error' => 'Journal entry not found.']);
        }

        // Check if the journal belongs to the current user
        if ($journalEntry->user_id != session('user')->id) {
            return redirect()->route('journal.list')->withErrors(['error' => 'You are not authorized to delete this journal entry.']);
        }

        $journalEntry->delete();

        return redirect()->route('journal.list')->with('success', 'Journal entry deleted successfully.');
    }
}

