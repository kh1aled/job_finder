<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth; // ✅ Correct import
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index($jobId)
    {
        $job = Job::findOrFail($jobId);
        
        return view('jobs.applications.index', ['job' => $job]);
    }
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string'
        ]);

        $path = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'cv' => $path,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',   // optional but recommended
        ]);

        return back()->with('success', 'Your application has been submitted.');
    }
}