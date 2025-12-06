<x-app-layout>
    <x-section-head class="mt-16">Apply for Job</x-section-head>

    <div class="max-w-3xl mx-auto p-6 space-y-6 bg-white/5 border border-white/10 rounded-xl">

        {{-- Job Info --}}
        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-gray-200">{{ $job->title }}</h1>
            <p class="text-gray-400">Company: {{ $job->user->name ?? 'Unknown' }}</p>
            <p class="text-gray-400">Location: {{ $job->location }}</p>
            <p class="text-gray-400">Salary: ${{ $job->salary }}</p>
            <p class="text-gray-400">Schedule: {{ $job->schedule }}</p>
        </div>

        {{-- Application Form --}}
        @auth
            @if (auth()->id() !== $job->user_id)
                @php
                    $alreadyApplied = \App\Models\Application::where('job_id', $job->id)
                        ->where('user_id', auth()->id())
                        ->exists();
                @endphp
                @if (!$alreadyApplied)
                    <form action="{{ route('applications.apply', $job->id) }}" method="POST" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Message / Cover Letter --}}
                        <div>
                            <label class="block text-gray-200 font-semibold mb-1" for="message">
                                Message / Cover Letter
                            </label>

                            <textarea autofocus name="message" id="message" rows="5"
                                class="bg-white/5 border-white/10 border text-start px-5 py-2 w-full rounded-xl max-w-xl"
                                placeholder="Write your application message here...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CV Upload --}}
                        <div>
                            <label class="block text-gray-200 font-semibold mb-1" for="cv">Upload CV / Resume</label>

                            <x-input-form id="cv" type="file" name="cv" :value="old('cv')" required />

                            @error('cv')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="mt-5 px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
                            Submit Application
                        </button>
                    </form>
                @else
                    <p class="mt-6 text-green-400 font-semibold">
                        ✅ You have already applied to this job.
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

    </div>
</x-app-layout>
