<footer class="bg-black border-t border-white/10 mt-12">
    <div class="max-w-[986px] mx-auto px-5 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- About Section -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Job Finder</h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                Find your dream job or hire the best talent. We connect companies with skilled professionals across the tech industry.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="flex flex-col gap-2 text-gray-400">
                <li><a href="{{ route('jobs.index') }}" class="hover:text-white transition">Jobs</a></li>
                <li><a href="{{ route('jobs.salary') }}" class="hover:text-white transition">Salaries</a></li>
                <li><a href="#" class="hover:text-white transition">Careers</a></li>
                <li><a href="#" class="hover:text-white transition">Companies</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Contact</h3>
            <ul class="flex flex-col gap-2 text-gray-400">
                <li>Email: <a href="mailto:support@jobfinder.com" class="hover:text-white transition">support@jobfinder.com</a></li>
                <li>Phone: <a href="tel:+201159107545" class="hover:text-white transition">+20 115 910 7545</a></li>
                <li>Address: Cairo, Egypt</li>
            </ul>
        </div>

    </div>

    <div class="border-t border-white/10 mt-6 py-4 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Job Finder. All rights reserved.
    </div>
</footer>
