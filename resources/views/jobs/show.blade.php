<x-app-layout>
    <x-section-head class="mt-16">Job Details</x-section-head>

    <div class="max-w-4xl mx-auto p-6 space-y-6 bg-white/5 border border-white/10 rounded-xl">

        {{-- Company Info --}}
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-gray-800 rounded-full overflow-hidden flex-shrink-0">
                <img src="{{ asset('storage/images/' . $job->user->avatar) }}" alt="{{ $job->user->name ?? 'Company' }}"
                    class="w-full h-full object-cover">
            </div>

            <div class="flex flex-col">
                <h1 class="text-lg text-gray-200 font-bold">{{ $job->user->name ?? 'Unknown Company' }}</h1>
                <p class="text-xs text-gray-400">{{ $job->created_at->diffForHumans() }}</p>
            </div>
        </div>

        {{-- Job Info --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-400">
            <div><span class="font-semibold text-gray-200">Title:</span> {{ $job->title }}</div>
            <div><span class="font-semibold text-gray-200">Salary:</span> ${{ $job->salary }}</div>
            <div><span class="font-semibold text-gray-200">Location:</span> {{ $job->location }}</div>
            <div><span class="font-semibold text-gray-200">Schedule:</span> {{ $job->schedule }}</div>
        </div>

        {{-- Job Image --}}
        <x-animate-image src="{{ asset('storage/posts/' . $job->avatar) }}"
            div_width="w-full h-80 sm:h-[32rem] mt-5 rounded-xl" alt="{{ $job->user->name ?? 'Company Logo' }}" />

        {{-- Apply Button --}}
        @auth
        @php
            $alreadyApplied = \App\Models\Application::where('job_id', $job->id)
                ->where('user_id', auth()->id())
                ->exists();
        @endphp

        @if (!$alreadyApplied)
            <a href="{{ url('jobs/' . $job->id . '/apply') }}"
                class="inline-block mt-6 px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
                Apply for this Job
            </a>
        @else
            <p class="mt-6 text-green-400 font-semibold">
                ✅ You have already applied to this job.
            </p>
        @endif
            @if (auth()->id() !== $job->user_id)
            @endif
        @else
            <div class="mt-6">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
                    Login to Apply
                </a>
            </div>
        @endauth

        {{-- Admin Controls --}}
        @can('update-job', $job)
            <div class="flex justify-end items-center gap-4 mt-8">
                <x-primary-link href="{{ route('jobs.edit', $job->id) }}">Update</x-primary-link>

                <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Delete</x-danger-button>
                </form>
            </div>
        @endcan

    </div>
</x-app-layout>
