{{-- Navbar Component --}}
<nav class="flex justify-between items-center py-4 border-b border-white/10 relative">

    <!-- Logo -->
    <a href="/" class="flex items-center gap-2 z-50">
        <img src="{{ Vite::asset('resources/images/whiteLogo.png') }}"
            class="w-10 opacity-90 hover:opacity-100 transition" alt="Logo">
        <span class="font-semibold text-lg md:text-xl">Job Finder</span>
    </a>

    <!-- Desktop Navigation -->
    <div class="hidden md:flex items-center gap-8 z-10">
        <x-nav-link href="{{ route('jobs.index') }}" :active="request()->routeIs('jobs.index')">Jobs</x-nav-link>
        <x-nav-link href="{{ route('jobs.salary') }}" :active="request()->routeIs('jobs.salary')">Salaries</x-nav-link>
        <x-nav-link href="{{ route('applications.byUser') }}">Applications</x-nav-link>
        <x-nav-link href="{{ route('companies.index') }}">Companies</x-nav-link>
    </div>

    <!-- Right Section -->
    <div class="hidden md:flex items-center gap-6 z-10">
        @auth
            <x-nav-link href="{{ route('jobs.create') }}" :active="request()->routeIs('jobs.create')">Post A Job</x-nav-link>
            <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">Your Profile</x-nav-link>
            <!-- Profile Dropdown -->
            <div class="relative">
                <img id="dropdown_controller"
                    class="w-12 h-12 rounded-full cursor-pointer ring-2 ring-white/10 hover:ring-teal-400/40 transition"
                    src="{{ asset('storage/images/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                <div id="dropdown"
                    class="absolute right-0 mt-3 w-48 bg-black/90 border border-white/10 rounded-xl p-4 scale-0 origin-top transition-all duration-200 z-50">
                    <div class="text-center">
                        <img class="w-12 h-12 rounded-full mx-auto mb-2"
                            src="{{ asset('storage/images/' . auth()->user()->avatar) }}" alt="">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();"
                            class="w-full justify-center">Logout</x-danger-button>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-nav-link>
            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-nav-link>
        @endguest
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobileToggle" class="md:hidden p-2 rounded-full hover:bg-white/10 transition z-50">
        <i class="ri-menu-line text-2xl"></i>
    </button>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="md:hidden absolute top-full right-0 w-full bg-black/95 border-t border-white/10 px-5 py-5 flex flex-col gap-4 transform -translate-y-full opacity-0 transition-all duration-300 z-40">
        <x-nav-link href="{{ route('jobs.index') }}" :active="request()->routeIs('jobs.index')">Jobs</x-nav-link>
        <x-nav-link href="{{ route('jobs.salary') }}" :active="request()->routeIs('jobs.salary')">Salaries</x-nav-link>
        <x-nav-link href="#">Careers</x-nav-link>
        <x-nav-link href="#">Companies</x-nav-link>

        @auth
            <x-nav-link href="{{ route('jobs.create') }}" :active="request()->routeIs('jobs.create')">Post A Job</x-nav-link>
            <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">Your Profile</x-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();"
                    class="w-full justify-center">Logout</x-danger-button>
            </form>
        @endauth

        @guest
            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-nav-link>
            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-nav-link>
        @endguest
    </div>

</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Profile Dropdown (desktop)
        const profileBtn = document.getElementById("dropdown_controller");
        const dropdown = document.getElementById("dropdown");
        if (profileBtn) {
            profileBtn.addEventListener("click", () => {
                dropdown.classList.toggle("scale-100");
            });
        }

        // Mobile Menu Toggle
        const mobileBtn = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('-translate-y-full');
                mobileMenu.classList.toggle('translate-y-0');
                mobileMenu.classList.toggle('opacity-0');
                mobileMenu.classList.toggle('opacity-100');
            });
        }

    });
</script>
