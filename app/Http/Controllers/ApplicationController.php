<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
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
        $job = Job::findOrFail($jobId);


        // Prevent employer from applying to own job
        if ($job->user_id == Auth::id()) {
            return back()->with('error', 'You cannot apply to your own job posting.');
        }

        // Prevent duplicate application
        if (Application::where('job_id', $jobId)->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You already applied for this job.');
        }

        // Validation
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string'
        ]);

        // Upload CV
        $path = $request->file('cv')->store('cvs', 'public');

        // Create application
        Application::create([
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'cv' => $path,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted.');
    }

public function applicationsByUser()
{
    $applications = Application::with('job', 'job.user')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('jobs.applications.byUser', compact('applications'));
}
}