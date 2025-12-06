<x-app-layout>
    <x-section-head class="mt-16">Companies</x-section-head>

    <div class="max-w-6xl mx-auto mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($companies as $company)
            <div
                class="bg-white/5 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center 
                        hover:shadow-2xl hover:scale-105 transition-transform duration-300 cursor-pointer group">

                {{-- Company Logo --}}
                <img src="{{ asset('storage/companies/' . $company['logo']) }}" alt="{{ $company['name'] }} Logo"
                    class="w-24 h-24 object-contain rounded-full mb-4 border border-white/20 
                            group-hover:border-indigo-600 transition-colors duration-300">

                {{-- Company Name --}}
                <h3
                    class="text-lg font-bold text-gray-200 truncate group-hover:text-indigo-500 transition-colors duration-300">
                    {{ $company['name'] }}
                </h3>

                {{-- Company Description --}}
                <p class="text-gray-400 text-sm mt-2 line-clamp-3">
                    {{ $company['description'] }}
                </p>

                {{-- View Jobs Button --}}
                <a href="#"
                    class="mt-4 px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg text-sm 
                          font-medium transition-colors duration-300 shadow-md hover:shadow-lg">
                    View Jobs
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
