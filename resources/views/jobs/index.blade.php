<x-app-layout>
    <div class="space-y-10 mt-12">
        <!-- Search Form Component -->
        <x-search-form />

        <!-- Featured Jobs Section -->
        <section>
            <x-section-heading>Featured Jobs</x-section-heading>

            @if ($featuredJobs->isNotEmpty())
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredJobs as $job)
                        <!-- Job Card Component -->
                        <x-job-card 
                            :id="$job->id" 
                            :title="$job->title" 
                            :user="$job->user" 
                            :salary="$job->salary"
                            :location="$job->location" 
                            :schedule="$job->schedule" 
                            :url="$job->url" 
                            :featured="$job->featured" 
                            :tags="$job->tags"
                            :avatar="$job->avatar"
                            class="transition-transform hover:scale-105 hover:shadow-lg rounded-xl"
                        />
                    @endforeach
                </div>
            @else
                <!-- No Featured Jobs Message -->
                <p class="text-center text-gray-400 text-xl mt-6">No featured jobs available.</p>
            @endif
        </section>

        <!-- Tags Section -->
        <section>
            <x-section-heading>Tags</x-section-heading>

            <div class="mt-6 flex flex-wrap gap-3">
                @forelse($tags as $tag)
                    <!-- Individual Tag Component -->
                    <x-tag>{{ $tag->name }}</x-tag>
                @empty
                    <!-- No Tags Message -->
                    <p class="text-center text-gray-400 text-xl mt-6">No tags available.</p>
                @endforelse
            </div>
        </section>

        <!-- Recent Jobs Section -->
        <section>
            <x-section-heading>Recent Jobs</x-section-heading>

            @if ($regularJobs->isNotEmpty())
                <div class="space-y-6">
                    @foreach ($regularJobs as $job)
                        <!-- Wide Job Card Component -->
                        <x-job-card-wide 
                            :id="$job->id" 
                            :title="$job->title" 
                            :user="$job->user" 
                            :salary="$job->salary"
                            :location="$job->location" 
                            :schedule="$job->schedule" 
                            :description="$job->description" 
                            :featured="$job->featured" 
                            :tags="$job->tags"
                            :avatar="$job->avatar"
                            class="transition-transform hover:scale-105 hover:shadow-lg rounded-xl"
                        />
                    @endforeach
                </div>
            @else
                <!-- No Recent Jobs Message -->
                <p class="text-center text-gray-400 text-xl mt-6">No recent jobs available.</p>
            @endif
        </section>
    </div>
</x-app-layout>