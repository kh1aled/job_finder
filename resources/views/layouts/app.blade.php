<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Finder</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/images/job_logo.png') }}">
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="min-h-screen bg-black text-white px-5 md:px-10">

        {{-- Navbar --}}
        <x-navbar />

        {{-- Page Content --}}
        <main class="mx-auto py-5 max-w-[986px]">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-footer />

    </div>

    <script>
        // Profile Dropdown
        const profileBtn = document.getElementById("dropdown_controller");
        const dropdown = document.getElementById("dropdown");

        if (profileBtn) {
            profileBtn.addEventListener("click", () => {
                dropdown.classList.toggle("scale-100");
                dropdown.classList.toggle("scale-0");
            });
        }

        // Mobile Menu Toggle (optional)
        const toggleBtn = document.getElementById('toggleBtn');
        // You can implement mobile menu toggle here
    </script>
</body>

</html>
