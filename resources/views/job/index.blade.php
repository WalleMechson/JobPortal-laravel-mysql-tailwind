@php
    $experienceLevels = [
        '' => 'All',
        'entry' => 'Entry',
        'intermediate' => 'Intermediate',
        'senior' => 'Senior'
    ];
    $categories = [
        '' => 'All',
        "it" => "IT",
        "finance" => "Finance",
        "sales" => "Sales",
        "marketing" => "Marketing"
    ];
@endphp

<x-layout>
    <div class="my-8"></div>
    <div x-data="{ open: false }">
        <button type="button" class="flex ml-auto mr-1 mb-1 border bg-white px-2 rounded-md" @click="open = !open">
            <span x-show="!open">&plus;</span>
            <span x-show="open">&minus;</span>
        </button>

        <x-card class="mb-4 text-sm">
            <form x-ref="filtersForm" action="{{route('jobs.index')}}" method="GET" class="px-1 overflow-hidden">
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <div class="mb-1 font-semibold">Search</div>
                        <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for your job"
                            formRef="filtersForm" />
                    </div>
                    <div>
                        <div class="mb-1 font-semibold">Salary</div>
                        <div class="flex space-x-2">
                            <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From"
                                formRef="filtersForm" />
                            <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To"
                                formRef="filtersForm" />
                        </div>
                    </div>
                    <div x-show="open">
                        <div class="mb-1 font-semibold">Experience</div>
                        @foreach ($experienceLevels as $value => $label)
                            <label for="{{ $value }}1" class="flex items-center mb-1">
                                <input type="radio" name="experience" id="{{ $value }}1" value="{{ $value }}"
                                    @checked($value === request('experience')) />
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div x-show="open">
                        <div class="mb-1 font-semibold">Category</div>
                        @foreach ($categories as $value => $label)
                            <label for="{{ $value }}1" class="flex items-center mb-1">
                                <input type="radio" name="category" id="{{ $value }}1" value="{{ $value }}"
                                    @checked(Str::ucfirst($value) === request('category')) />
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <x-link-button class="w-full block" onclick="this.closest('form').submit()">
                    Filter
                </x-link-button>
            </form>
        </x-card>
    </div>

    @foreach($jobs as $job)
        <x-job-card :$job>
            <x-link-button :href="route('jobs.show', $job)"> Show </x-link-button>
        </x-job-card>
    @endforeach

    @if($jobs->count())
        {{ $jobs->onEachSide(1/5)->links() }} <!-- This will show 2 buttons on each side of the current page -->
    @endif

</x-layout>