<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view("job_application.create", ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {

        $validatedData = $request->validate([
            "expected_salary" => "required|min:1|max:1000000",
            "cv" => 'required|file|mimes:pdf|max:5110',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'public');

        $job->jobApplications()->create([
            "user_id" => auth()->user()->id,
            'expected_salary' => $validatedData["expected_salary"],
            "cv_path" => $path,
        ]);
        return redirect()->route("jobs.show", ['job' => $job])->with("success", "Application sent successfully");
    }
    public function downloadCv($filename)
    {
        if (Storage::disk('public')->exists("cvs/".$filename)) {
            return Storage::disk('public')->download("cvs/".$filename);
        } else {
            abort(404, 'File not found.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
