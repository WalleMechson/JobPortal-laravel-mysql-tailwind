<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use \App\Models\Job;
class MyJobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAnyEmployer", Job::class);
        return view("my_job.index", ['jobs' => auth()->user()->employer->jobs()->with(['employer', 'jobApplications', 'jobApplications.user'])->withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Job::class);

        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // dd($request->all());

        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'location' => 'required|string|max:255',
        //     'salary' => 'required|numeric|min:5000',
        //     'description' => 'required|string',
        //     'category' => 'required|in:' . implode(',', \App\Models\Job::$category),
        //     'experience' => 'required|in:' . implode(',', \App\Models\Job::$experience),
        // ]);
        $this->authorize("create", Job::class);

        auth()->user()->employer->jobs()->create($request->validated());
        return redirect()->route('my-jobs.index')->with('success', 'Job has been added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Job $myJob)
    {
        $this->authorize("update", $myJob);
        return view('my_job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, \App\Models\Job $myJob)
    {
        $this->authorize("update", $myJob);
        $myJob->update($request->validated());
        return redirect()->route('my-jobs.index')->with('success', 'Job has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()->route('my-jobs.index')->with('success','Job deleted successfully!');
    }
}
