<x-app-layout>
    <div class="border border-white/10 w-full rounded-t-xl text-white">

        {{-- Profile Information --}}
        <div class="mt-5 px-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <img 
                    class="w-24 h-24 rounded-full ring-4 ring-white/20 shadow-lg object-cover"
                    src="{{ asset('storage/images/' . auth()->user()->avatar) }}" 
                    alt="{{ auth()->user()->name }}" 
                />
                <div>
                    <h1 class="text-3xl font-bold capitalize">{{ auth()->user()->name }}</h1>
                    <p class="text-white/70 mt-1">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            <x-black-link 
                href="/profile/edit"
                class="px-4 py-2 bg-white/10 rounded-lg hover:bg-white/20 transition self-start md:self-center">
                Edit Profile
            </x-black-link>
        </div>

        {{-- Job Posts Navigation --}}
        <nav class="w-full border-b border-white/10 py-2.5 flex justify-center mt-5">
            <x-nav-link class="cursor-pointer">
                <span class="text-center relative font-semibold text-white/90 hover:text-white transition">
                    Job Posts
                    <span class="line_after"></span>
                </span>
            </x-nav-link>
        </nav>

        {{-- Job Posts Grid --}}
        <div class="px-3 py-5 grid gap-5 grid-cols-1 md:grid-cols-2">
            @if ($jobPosts->isNotEmpty())
                @foreach ($jobPosts as $job)
                    <div class="transition transform hover:shadow-lg rounded-xl bg-white/5 p-4 border border-transparent hover:border-blue-800 cursor-pointer">
                        <x-job-profile-wide 
                            :id="$job->id" 
                            :title="$job->title" 
                            :employer="$job->employer" 
                            :salary="$job->salary"
                            :location="$job->location" 
                            :schedule="$job->schedule" 
                            :url="$job->url" 
                            :featured="$job->featured" 
                            :tags="$job->tags"
                            :avatar="$job->avatar" 
                        />
                    </div>
                @endforeach
            @else
                <p class="text-center text-xl mt-6 text-white/70">No recent jobs available.</p>
            @endif
        </div>
    </div>
</x-app-layout>
