<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />
    <x-job-card :job="$job" />

    <x-card class="my-8">
        <h2 class="mb-4 text-lg font-medium">Your Job Application</h2>
        <form method="POST" action="{{route('job.applications.store', $job) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="expected_salary">Expected
                    salary</label>
                <x-text-input type="number" name="expected_salary" />
            </div>

            <div class="mb-4">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="cv">Upload your CV</label>
                <x-text-input type="file" name="cv" />
            </div>

            <x-link-button class="block bg-slate-100 hover:bg-slate-50"
                onclick="this.closest('form').submit()">Apply</x-link-button>
        </form>
    </x-card>
</x-layout>