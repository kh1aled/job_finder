<x-app-layout>
    <div class="space-y-10 mt-12 px-4">

        <x-section-heading>All Job Salaries</x-section-heading>

        @if($jobs->isNotEmpty())
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div 
                        class="rounded-xl p-6 shadow-xl bg-white/5 transition duration-300 
                               transform hover:scale-105 hover:shadow-2xl text-center"
                    >
                        <h3 class="text-xl font-bold text-white mb-2">{{ $job->title }}</h3>

                        <p class=" text-blue-400 font-semibold text-lg mb-2">
                            💰 Salary: {{ $job->salary }} EGP
                        </p>

                        <p class="text-gray-300 text-sm mb-1">
                            🕒 Schedule: {{ $job->schedule }}
                        </p>

                        <p class="text-gray-400 text-sm">
                            📍 Location: {{ $job->location }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-xl mt-6 text-gray-400">No jobs available.</p>
        @endif

    </div>
</x-app-layout>
