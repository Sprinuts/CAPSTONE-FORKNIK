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

            return redirect()->route('journalview')->with('success', 'Journal entry created successfully.');
        }
    }
}
