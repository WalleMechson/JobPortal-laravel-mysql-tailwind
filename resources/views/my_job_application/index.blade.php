<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), 'My Job Applications' => '#']" />
    @forelse($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>Sent application: <span class="font-bold">{{$application->created_at->diffForHumans()}}</span>
                    </div>
                    <div>Other {{Str::plural("applicant", $application->job->job_applications_count - 1)}}: <span
                            class="font-bold">{{$application->job->job_applications_count - 1}}</span>
                    </div>
                    <div>Your asking salary: <span
                            class="font-bold">${{number_format($application->expected_salary)}}</span>
                    </div>
                    <div>Average salary: <span
                            class="font-bold">${{number_format($application->job->job_applications_avg_expected_salary)}}</span>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{route('my_job_applications.destroy', $application)}}">
                        @csrf
                        @method('DELETE')
                        <button class="border border-slate-400 rounded-md px-2 py-1 hover:bg-slate-50">Cancel</button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="text-center bg-white rounded-md py-2 px-1.5">
            <h1>You haven't yet applied to any job offer</h1>
            <h1><a href="{{route('jobs.index')}}" class="underline text-purple-600 hover:no-underline">Apply jobs here</a>
            </h1>
        </div>
    @endforelse

</x-layout>