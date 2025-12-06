<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pixel Position</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @vite('resources/css/app.css') --}}

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


</head>

<body class="font-sans antialiased bg-black">
    <div class="min-h-screen bg-black text-white px-10">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- page header --}}

        <nav class="flex justify-between items-center py-4 border-b border-white/10">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}"
                    class="w-10 opacity-90 hover:opacity-100 transition" alt="Logo">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <x-nav-link href="{{ route('jobs.index') }}" :active="request()->routeIs('jobs.index')">
                    Jobs
                </x-nav-link>

                <x-nav-link href="{{ route('jobs.salary') }}" :active="request()->routeIs('jobs.salary')">
                    Salaries
                </x-nav-link>

                <x-nav-link href="">Careers</x-nav-link>
                <x-nav-link href="">Companies</x-nav-link>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-6">

                @auth
                    <x-nav-link href="{{ route('jobs.create') }}" :active="request()->routeIs('jobs.create')">
                        Post A Job
                    </x-nav-link>

                    <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        Your Profile
                    </x-nav-link>

                    <div class="relative">
                        <img id="dropwdown_controller"
                            class="size-12 rounded-full cursor-pointer ring-2 ring-white/10 hover:ring-teal-400/40 transition"
                            src="{{ asset('storage/images/' . auth()->user()->avatar) }}" alt="">

                        <div id="dropwdown"
                            class="dropdown_profile absolute right-0 mt-3 w-48 bg-black/90 border border-white/10 rounded-xl p-4 scale-0 origin-top transition duration-150">
                            <div class="text-center">
                                <img class="size-12 rounded-full mx-auto mb-2"
                                    src="{{ asset('storage/images/' . auth()->user()->avatar) }}" alt="">

                                <p class="font-semibold">{{ auth()->user()->name }}</p>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="w-full justify-center">
                                    Logout
                                </x-danger-button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <x-nav-link href="/login" :active="request()->routeIs('login')">Login</x-nav-link>
                    <x-nav-link href="/register" :active="request()->routeIs('register')">Register</x-nav-link>
                @endguest

                <!-- Mobile Menu Button -->
                <button id="toggleBtn" class="md:hidden p-2 rounded-full hover:bg-white/10 transition">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>

        </nav>


        <!-- Page Content -->
        <main class="mx-auto py-5 max-w-[986px]">
            {{ $slot }}
        </main>
    </div>
</body>

</html>

<script>
    const profileBtn = document.getElementById("dropwdown_controller");
    const menu = document.getElementById("dropwdown");

    if (profileBtn) {
        profileBtn.addEventListener("click", () => {
            menu.classList.toggle("scale-100");
            menu.classList.toggle("scale-0");
        });
    }
</script>
