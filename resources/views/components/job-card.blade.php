@props(['id', 'title', 'user', 'salary', 'location', 'schedule', 'description', 'featured', 'tags', 'avatar'])


<a id="{{ $id }}" href="{{ route('jobs.show', $id) }}"
    {{ $attributes->merge(['class' => 'flex flex-col bg-white/5 justify-center duration-300 items-center p-4 bg-red-700 rounded-xl gap-3 text-center border border-transparent transition-colors hover:border-blue-800 cursor-pointer group']) }}>

    <h3 class="self-start text-sm">{{ $user->name ?? 'Unknown User' }}</h3>

    <div class="font-bold py-8">
        <h1 class="group-hover:text-blue-600 duration-300">{{ $title ?? 'Untitled Job' }}</h1>
        <p class="text-sm mt-4 text-gray-400">
            {{ $schedule ?? 'Flexible Schedule' }} - From {{ $salary ?? 'Negotiable' }}
        </p>
    </div>

    <div class="w-full flex justify-between items-center gap-4">
        <div class="flex flex-wrap flex-1 min-w-0 gap-2">
            @foreach ($tags as $tag)
                <x-tag class="small">{{ $tag->name ?? 'No Tag' }}</x-tag>
            @endforeach
        </div>


        <x-animate-image src="{{ asset('storage/posts/' . e($avatar)) }}" div_width="w-[5rem]" alt="{{ $employer->name ?? 'Company' }} Logo"/>

    </div>

</a>
