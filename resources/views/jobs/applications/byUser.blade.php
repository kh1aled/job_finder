<x-app-layout>
    <x-section-head class="mt-16">My Applications</x-section-head>

    <div class="max-w-5xl mx-auto space-y-6 mt-6">

        @php
            $applications = \App\Models\Application::with(['job', 'job.user', 'job.tags'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        @endphp

        @if($applications->isEmpty())
            <p class="text-gray-400 text-center">You have not applied to any jobs yet.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($applications as $application)
                    @php
                        $job = $application->job;
                        $tags = $job->tags;
                    @endphp

                    <a id="{{ $job->id }}" href="{{ route('jobs.show', $job->id) }}"
                        class="flex flex-col sm:flex-row items-center sm:items-start p-4 gap-4 bg-white/5 rounded-xl border border-transparent hover:border-blue-800 cursor-pointer transition-colors duration-300 group">

                        {{-- Job avatar --}}
                        <x-animate-image 
                            src="{{ asset('storage/posts/' . e($job->avatar)) }}" 
                            div_width="w-20 sm:w-24" 
                            alt="{{ $job->user->name ?? 'Company Logo' }}" 
                            class="flex-shrink-0 rounded-xl object-cover"
                        />

                        {{-- Job details --}}
                        <div class="flex-1 min-w-0 space-y-2 text-center sm:text-left">
                            <h4 class="text-sm text-gray-400 truncate">{{ $job->user->name ?? 'Unknown User' }}</h4>
                            <h1 class="font-bold text-lg truncate group-hover:text-blue-600 duration-300">{{ $job->title ?? 'Untitled Job' }}</h1>
                            <p class="text-sm text-gray-400 truncate">{{ $job->schedule ?? 'Flexible Schedule' }} - ${{ $job->salary ?? 'Negotiable' }}</p>

                            {{-- Tags --}}
                            @if($tags->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mt-2 justify-center sm:justify-start">
                                    @foreach ($tags as $tag)
                                        <x-tag class="base">{{ $tag->name }}</x-tag>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Status --}}
                            <p class="mt-2 text-sm">
                                Status: 
                                @if($application->status === 'pending')
                                    <span class="text-yellow-400 font-semibold">Pending</span>
                                @elseif($application->status === 'accepted')
                                    <span class="text-green-400 font-semibold">Accepted</span>
                                @elseif($application->status === 'rejected')
                                    <span class="text-red-400 font-semibold">Rejected</span>
                                @endif
                            </p>

                            <p class="text-gray-400 text-xs">Applied on: {{ $application->created_at->format('M d, Y') }}</p>
                        </div>

                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
