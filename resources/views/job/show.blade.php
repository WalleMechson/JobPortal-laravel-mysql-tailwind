<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :noDescription="true" :job="$job">
        <p class="text-slate-500 text-sm mb-4">{!! nl2br(e($job->description)) !!}</p>

        @auth
            @can('apply', $job)
                <x-link-button :href="route('job.applications.create', $job)">Apply</x-link-button>
            @else
                <div class="text-center text-sm font-medium text-slate-700 border px-2 py-2">You already have applied for this
                    job</div>
            @endcan
        @else
            <div class="text-center text-sm font-medium text-slate-700 border px-2 py-2"><a href="/login"
                    class="underline hover:no-underline font-bold">Login</a> to apply for job</div>
        @endauth
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More <strong><u>{{ $job->employer->company_name}}</u></strong> Jobs
        </h2>

        <div class="text-sm text-slate-500">
            @foreach($job->employer->jobs as $otherJob)
                <div class="mb-4 flex justify-between p-2 border {{ $otherJob->id === $job->id ? " bg-slate-100" : ""}}">
                    <div>
                        <div class=" text-slate-700 font-semibold">
                            <a class="hover:underline" href="{{route('jobs.show', $otherJob)}}">{{$otherJob->title}}</a>
                        </div>
                        <div class="text-xs">
                            {{$otherJob->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="text-xs">
                        ${{number_format($otherJob->salary)}}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>