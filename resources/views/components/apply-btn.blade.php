{{-- Apply Button --}}
@auth
    @if (auth()->id() !== $job->user_id)
        @php
            $alreadyApplied = \App\Models\Application::where('job_id', $job->id)
                ->where('user_id', auth()->id())
                ->exists();
        @endphp

        @if (!$alreadyApplied)
            <a href="{{ route('jobs.apply', $job->id) }}"
               class="inline-block mt-6 px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
                Apply for this Job
            </a>
        @else
            <p class="mt-6 text-green-400 font-semibold">
                 You have already applied to this job.
            </p>
        @endif
    @endif
@else
    <div class="mt-6">
        <a href="{{ route('login') }}"
           class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
           Login to Apply
        </a>
    </div>
@endauth
