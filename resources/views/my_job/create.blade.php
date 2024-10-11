@php
    $experienceLevels = [
        'entry' => 'Entry',
        'intermediate' => 'Intermediate',
        'senior' => 'Senior'
    ];
    $categories = [
        "IT" => "IT",
        "Finance" => "Finance",
        "Sales" => "Sales",
        "Marketing" => "Marketing"
    ];
@endphp

<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), 'My Jobs' => route('my-jobs.index'), 'Create Job' => '#']" />

    <x-card>
        <form method="POST" action="{{route('my-jobs.store')}}" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @csrf
            <div class="sm:col-span-1">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="title">Job title</label>
                <x-text-input type="text" name="title" />
            </div>
            <div class="sm:col-span-1">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="location">Job location</label>
                <x-text-input type="text" name="location" />
            </div>
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="salary">Job salary</label>
                <x-text-input type="text" name="salary" />
            </div>
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="description">Job
                    description</label>
                <x-text-input type="textarea" name="description" />
            </div>
            <div class="sm:col-span-1">
                <div class="mb-1 font-semibold">Experience</div>
                @foreach ($experienceLevels as $value => $label)
                    <label for="{{ $value }}1" class="flex items-center mb-1">
                        <input type="radio" name="experience" id="{{ $value }}1" value="{{ $value }}"
                            @checked($value === request('experience')) />
                        <span class="ml-2">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <div class="sm:col-span-1">
                <div class="mb-1 font-semibold">Category</div>
                @foreach ($categories as $value => $label)
                    <label for="{{ $value }}1" class="flex items-center mb-1">
                        <input type="radio" name="category" id="{{ $value }}1" value="{{ $value }}"
                            @checked(Str::ucfirst($value) === request('category')) />
                        <span class="ml-2">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <x-link-button class="block mt-4 bg-slate-100 sm:col-span-2 hover:bg-slate-50"
                onclick="this.closest('form').submit()">Apply</x-link-button>
        </form>
    </x-card>
</x-layout>