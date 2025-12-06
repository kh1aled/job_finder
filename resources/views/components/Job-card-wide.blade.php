@props(['id', 'title', 'user', 'salary', 'location', 'schedule', 'featured', 'tags', 'avatar'])

<a id="{{ $id }}" href="{{ route('jobs.show', $id) }}"
    {{ $attributes->merge([
        'class' => 'flex flex-col sm:flex-row items-center sm:items-start p-4 gap-4 bg-white/5 rounded-xl border border-transparent hover:border-blue-800 cursor-pointer transition-colors duration-300'
    ]) }}>

    {{-- Job avatar --}}
    <x-animate-image 
        src="{{ asset('storage/posts/' . e($avatar)) }}" 
        div_width="w-20 sm:w-24" 
        alt="{{ $user->name ?? 'Company Logo' }}" 
        class="flex-shrink-0"
    />

    {{-- Job details --}}
    <div class="flex-1 min-w-0 space-y-2 text-center sm:text-left">
        <h4 class="text-sm text-gray-400 truncate">{{ $user->name ?? 'Unknown User' }}</h4>
        <h1 class="font-bold text-lg truncate group-hover:text-blue-600 duration-300">{{ $title ?? 'Untitled Job' }}</h1>
        <p class="text-sm text-gray-400 truncate">{{ $schedule ?? 'Flexible Schedule' }} - From {{ $salary ?? 'Negotiable' }}</p>

        {{-- Tags --}}
        @if($tags->isNotEmpty())
            <div class="flex flex-wrap gap-2 mt-2 justify-center sm:justify-start">
                @foreach ($tags as $tag)
                    <x-tag class="base">{{ $tag->name }}</x-tag>
                @endforeach
            </div>
        @endif
    </div>

</a>
