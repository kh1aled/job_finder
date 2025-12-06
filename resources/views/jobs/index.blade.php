<x-app-layout>
    <div class="space-y-10 mt-12">
        <!-- نموذج البحث -->
        <x-search-form />

        <!-- الوظائف المميزة -->
        <section>
            <x-section-heading>Featured Jobs</x-section-heading>

            @if ($featuredJobs->isNotEmpty())
                <div class="grid lg:grid-cols-3 gap-8">
                    @foreach ($featuredJobs as $job)
                        <x-job-card :id="$job->id" :title="$job->title" :user="$job->user" :salary="$job->salary"
                            :location="$job->location" :schedule="$job->schedule" :url="$job->url" :featured="$job->featured" :tags="$job->tags"
                            :avatar="$job->avatar" />
                    @endforeach
                </div>
            @else
                <p class="text-center text-xl mt-6">No featured jobs available.</p>
            @endif
        </section>

        <!-- الوسوم -->
        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 flex justify-start items-center gap-2 flex-wrap">
                @forelse($tags as $tag)
                    <x-tag>{{ $tag->name }}</x-tag>
                @empty
                    <p class="text-center text-xl mt-6">No tags available.</p>
                @endforelse
            </div>
        </section>

        <!-- أحدث الوظائف -->
        <section>
            <x-section-heading>Recent Jobs</x-section-heading>
            @if ($regularJobs->isNotEmpty())
                @foreach ($regularJobs as $job)
                    <x-job-card-wide :id="$job->id" :title="$job->title" :user="$job->user" :salary="$job->salary"
                        :location="$job->location" :schedule="$job->schedule" :description="$job->description" :featured="$job->featured" :tags="$job->tags"
                        :avatar="$job->avatar" />
                @endforeach
            @else
                <p class="text-center text-xl mt-6">No recent jobs available.</p>
            @endif
        </section>

        <!-- قسم إضافي -->
        <section class="mt-5">
            <x-section-heading>Additional Section</x-section-heading>
            <x-panel>
                <h5>Hello There</h5>
            </x-panel>
        </section>
    </div>
</x-app-layout>
