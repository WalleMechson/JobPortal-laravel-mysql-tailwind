<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JobHatch</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="mx-auto max-w-2xl mb-10 mt-10 bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 text-slate-700">
    <nav class="flex justify-between text-lg font-medium p-2">
        <div class="block sm:hidden">
            <button id="burger-menu" class="focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <ul class="flex space-x-2">
            <li><a href="/" class="hover:underline">Home</a></li>
        </ul>

        <ul class="hidden sm:flex space-x-2 items-center">
            @auth
                <li>
                    <a href="{{ route('my_job_applications.index') }}" class="hover:underline">
                        {{ auth()->user()->name ?? "Guest" }}: Applications
                    </a>
                </li>
                <li>|</li>
                <li><a href="{{ route('my-jobs.index') }}" class="hover:underline">My Jobs</a></li>
                <li>|</li>
                <li>
                    <form method="post" action="{{ route('auth.destory') }}">
                        @csrf
                        @method('DELETE')
                        <button class="border border-slate-400 rounded-md px-2 py-1 hover:bg-slate-50">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a class="border border-slate-400 rounded-md px-2 py-1 hover:bg-slate-50"
                        href="{{ route('auth.create') }}">
                        Sign in
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    <div id="mobile-menu"
        class="fixed top-0 left-0 w-full h-full bg-white transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex justify-between p-4">
            <h2 class="text-lg font-bold">Menu</h2>
            <button id="close-menu" class="focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <ul class="flex flex-col space-y-4 text-center">
            <li><a href="/" class="hover:underline text-xl">Home</a></li>
            @auth
                <li>
                    <a href="{{ route('my_job_applications.index') }}" class="hover:underline text-xl">
                        {{ auth()->user()->name ?? "Guest" }}: Applications
                    </a>
                </li>
                <li><a href="{{ route('my-jobs.index') }}" class="hover:underline text-xl">My Jobs</a></li>
                <li>
                    <form method="post" action="{{ route('auth.destory') }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="border border-slate-400 rounded-md px-2 py-1 hover:bg-slate-50 text-xl">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a class="border border-slate-400 rounded-md px-2 py-1 hover:bg-slate-50 text-xl"
                        href="{{ route('auth.create') }}">
                        Sign in
                    </a>
                </li>
            @endauth
        </ul>
    </div>



    @if(session('success'))
        <div role="alert"
            class="my-8 relative rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
            <p class="font-bold">Success!</p>
            <p>{{session('success')}}</p>
            <button type="button" class="absolute top-2 right-6 hover:opacity-80"
                onclick="this.parentElement.remove()">x</button>
        </div>
    @endif
    @if(session('error'))
        <div role="alert" class="my-8 relative rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
            <p class="font-bold">Error!</p>
            <p>{{session('error')}}</p>
            <button type="button" class="absolute top-2 right-6 hover:opacity-80"
                onclick="this.parentElement.remove()">x</button>
        </div>
    @endif
    <div class="p-2">
        {{ $slot }}
    </div>
    <script>
        const burgerMenu = document.getElementById('burger-menu');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        burgerMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('-translate-x-full');
        });

        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('-translate-x-full');
        });
    </script>

</body>

</html>