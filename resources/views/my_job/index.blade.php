<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), 'My Jobs' => '#']" />
    <div class="flex justify-end mb-4">
        <x-link-button :href="route('my-jobs.create')" class="bg-white">Add new job</x-link-button>
    </div>
    @forelse($jobs as $job)
        <x-job-card :job="$job">
            <div class="text-sm text-slate-500 mb-4">
                @forelse($job->jobApplications as $application)
                    <div class="mt-4 border-2 border-dashed p-1.5">
                        <div>
                            <h4>Name: <span class="font-bold">{{$application->user->name}}</span></h4>
                        </div>
                        <div>
                            <h4>Applied: <span class="font-bold">{{$application->created_at->diffForHumans()}}</span></h4>
                        </div>
                        <div>
                            <h4>Asking salary: <span class="font-bold">${{number_format($application->expected_salary)}}</span>
                            </h4>
                        </div>
                        @if($application->cv_path)
                            <div>
                                <h4 class="underline hover:text-slate-700 cursor-pointer w-fit">
                                    <a href="{{ route('download-cv', basename($application->cv_path)) }}">Download
                                        CV</a>
                                </h4>
                            </div>
                        @else
                            <div>No CV provided</div>
                        @endif
                    </div>
                @empty
                    <div class="text-center bg-white border-2 border-dashed rounded-md py-2 px-1.5">
                        <h1>There are no applications yet.</h1>
                    </div>
                @endforelse
            </div>
            <div class="flex items-center space-x-2">
                <x-link-button :href="route('my-jobs.edit', ['my_job' => $job])">Edit</x-link-button>
                <form method="POST" action="{{route('my-jobs.destroy', ['my_job' => $job])}}">
                    @csrf
                    @method('DELETE')
                    <x-link-button onclick="this.closest('form').submit()">Delete</x-link-button>
                </form>
            </div>
        </x-job-card>
    @empty
        <x-card>
            <div class="text-center bg-white rounded-md py-2 px-1.5">
                <h1>There are no jobs created by you yet.</h1>
                <h1><a href="{{route('my-jobs.create')}}" class="underline text-purple-600 hover:no-underline">Create new
                        jobs here</a>
                </h1>
            </div>
        </x-card>
    @endforelse
</x-layout>