<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Set new password</h1>
    <x-card>
        <form action="{{route('password.update')}}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="py-8 px-16">
                <div class="mb-8">
                    <label for="password" class="mb-2 text-sm text-slate-900 block font-medium">New password</label>
                    <x-text-input name="password" />
                </div>
                <div class="mb-8">
                    <label for="password_confirmation" class="mb-2 text-sm text-slate-900 block font-medium">Confirm new
                        password</label>
                    <x-text-input name="password_confirmation" />
                </div>


                <x-link-button class="block bg-green-100 hover:bg-green-50"
                    onclick="this.closest('form').submit()">Reset password</x-link-button>
            </div>
        </form>
    </x-card>
</x-layout>