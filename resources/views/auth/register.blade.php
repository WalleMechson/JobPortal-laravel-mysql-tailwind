<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Sign in to your account</h1>
    <x-card>
        <form action="{{route('auth.storeUser')}}" method="POST">
            @csrf
            <div class="py-8 px-16">
                <div class="mb-8">
                    <label for="name" class="mb-2 text-sm text-slate-900 block font-medium">Name</label>
                    <x-text-input name="name" />
                </div>
                <div class="mb-8">
                    <label for="email" class="mb-2 text-sm text-slate-900 block font-medium">E-mail</label>
                    <x-text-input name="email" />
                </div>
                <div class="mb-8">
                    <label for="password" class="mb-2 text-sm text-slate-900 block font-medium">Password</label>
                    <x-text-input name="password" type="password" />
                </div>
                <x-link-button class="block bg-green-100 hover:bg-green-50"
                    onclick="this.closest('form').submit()">Register</x-link-button>
            </div>
        </form>
        <div class="flex justify-center">
            <span>Already have an account? <a href="{{route('auth.create')}}" class="text-purple-700">Login
                    here</a></span>
        </div>
    </x-card>
</x-layout>