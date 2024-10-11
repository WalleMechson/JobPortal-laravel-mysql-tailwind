<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Job;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Job::class);
        $filters = request()->only("search", "min_salary", "max_salary", "experience", "category");
        return view('job.index', ["jobs" => Job::with('employer')->latest()->filter($filters)->paginate(5)]);
    }


    public function show(Job $job)
    {
        return view("job.show", ["job" => $job->load('employer.jobs', 'jobApplications')]);
    }

}
