<x-app-layout>
    <div class="border-x border-white/10 w-full border-top-0 rounded-t-xl text-white">
        {{-- Profile Cover --}}
        <div class="w-full h-[15rem] overflow-hidden rounded-t-xl">
            <x-animate-image 
                src="{{ asset('storage/images/1740112289.png') }}" 
                div_width="w-full h-full object-cover" 
                alt="{{ $employer->name ?? 'Company' }} Logo" 
            />
        </div>

        {{-- Profile Information --}}
        <div class="mt-3 px-5">
            <div class="w-full flex justify-between items-start">
                <img 
                    class="inline-block w-24 h-24 rounded-full -translate-y-1/2 ring-4 ring-white/20 shadow-lg object-cover"
                    src="{{ asset('storage/images/' . auth()->user()->avatar) }}" 
                    alt="{{ auth()->user()->name }}" 
                />
                <x-black-link 
                    href="/profile/edit"
                    class="self-center px-4 py-2 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    Edit Profile
                </x-black-link>
            </div>
            <h1 class="text-3xl font-bold capitalize mt-2 -translate-y-1/2">{{ auth()->user()->name }}</h1>
        </div>

        {{-- Job Posts Navigation --}}
        <nav class="w-full border-b border-white/10 py-2.5 flex justify-center items-center relative">
            <x-nav-link class="cursor-pointer">
                <a href="" class="text-center relative font-semibold text-white/90 hover:text-white transition">
                    Job Posts
                    <span class="line_after"></span>
                </a>
            </x-nav-link>
        </nav>

        {{-- Job Posts Grid --}}
        <div class="px-3 py-5 grid gap-5 grid-cols-1">
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
