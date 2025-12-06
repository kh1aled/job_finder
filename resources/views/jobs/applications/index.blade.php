<x-app-layout>
    <x-section-head class="mt-16">Apply for Job</x-section-head>

    <div class="max-w-3xl mx-auto p-6 space-y-6 bg-white/5 border border-white/10 rounded-xl">

        {{-- Job Information --}}
        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-gray-200">{{ $job->title }}</h1>
            <p class="text-gray-400">Company: {{ $job->user->name ?? 'Unknown' }}</p>
            <p class="text-gray-400">Location: {{ $job->location }}</p>
            <p class="text-gray-400">Salary: ${{ $job->salary }}</p>
            <p class="text-gray-400">Schedule: {{ $job->schedule }}</p>
        </div>

        {{-- Application Form --}}
        @auth
            @php
                $user = auth()->user();
                $hasApplied = $job->applications()->where('user_id', $user->id)->exists();
                $isOwner = $job->user_id === $user->id;
            @endphp

            @if ($isOwner)
                <p class="text-yellow-400 font-semibold mt-4">You cannot apply to your own job.</p>
            @elseif ($hasApplied)
                <p class="text-green-400 font-semibold mt-4">You have already applied for this job.</p>
            @else
                <form action="{{ route('applications.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Cover Letter Field -->
                    <div>
                        <label class="block text-gray-200 font-semibold mb-1" for="cover_letter">Cover Letter</label>
                        <textarea name="cover_letter" id="cover_letter" rows="5"
                                  class="bg-white/5 border border-white/10 px-5 py-2 w-full rounded-xl"
                                  placeholder="Write your application cover letter here...">{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CV / Resume Upload -->
                    <div>
                        <label class="block text-gray-200 font-semibold mb-1" for="cv">Upload CV / Resume</label>
                        <x-input-form id="cv" type="file" name="cv" required />
                        @error('cv')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="mt-5 px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition">
                        Submit Application
                    </button>
                </form>
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
