<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Sign in to your account</h1>
    <x-card>
        <form action="{{route('auth.store')}}" method="POST">
            @csrf
            <div class="py-8 px-16">
                <div class="mb-8">
                    <label for="email" class="mb-2 text-sm text-slate-900 block font-medium">E-mail</label>
                    <x-text-input name="email" />
                </div>
                <div class="mb-8">
                    <label for="password" class="mb-2 text-sm text-slate-900 block font-medium">Password</label>
                    <x-text-input name="password" type="password" />
                </div>
                <div class="mb-8 flex justify-between text-sm font-medium">
                    <div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="rounded-sm border border-slate-400" />
                            <label for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-indigo-900 hover:underline">Forget password</a>
                    </div>
                </div>
                <x-link-button class="block bg-green-100 hover:bg-green-50"
                    onclick="this.closest('form').submit()">Login</x-link-button>
            </div>
        </form>
        <div class="flex justify-center">
            <span>Don't have an account? <a href="{{route('auth.register')}}" class="text-purple-700">Register
                    here</a></span>
        </div>

    </x-card>
</x-layout>