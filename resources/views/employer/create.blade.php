<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), 'Create Employer' => '#']" class="mb-4" />
    <x-card>
        <div class="mb-4">
            <h2 class="mb-4 text-lg font-medium">Create yourself as an Employer</h2>
            <form method="POST" action="{{route('employer.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-slate-900" for="company_name">Company name</label>
                    <x-text-input type="text" name="company_name" />
                </div>

                <x-link-button class="block bg-slate-100 hover:bg-slate-50"
                    onclick="this.closest('form').submit()">Create</x-link-button>
            </form>
        </div>
    </x-card>
</x-layout>