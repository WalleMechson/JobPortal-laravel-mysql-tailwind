<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Forgot password</h1>
    <x-card>
        <form action="{{route('password.email')}}" method="POST">
            @csrf
            <div class="py-8 px-16">

                <div class="mb-8">
                    <label for="email" class="mb-2 text-sm text-slate-900 block font-medium">E-mail</label>
                    <x-text-input name="email" />
                </div>

                <x-link-button class="block bg-green-100 hover:bg-green-50"
                    onclick="this.closest('form').submit()">Get password reset link</x-link-button>
            </div>
        </form>
    </x-card>
</x-layout>