@props(['id', 'title', 'employer', 'salary', 'location', 'schedule', 'url', 'featured', 'tags', 'avatar'])

<div
    class="justify-start items-center px-4 py-8  gap-6 mt-5  flex  duration-300  rounded-xl text-center ">


    <x-animate-image src="{{ asset('storage/posts/' . e($avatar)) }}" div_width="size-12 rounded-full" />

    <div>
        <h1 class="font-bold text-lg text-start duration-300">{{ $title }}</h1>
        <h4 class="text-sm text-gray-400">{{ $schedule }} - From {{ $salary }}</h4>
    </div>

    <div class="flex-1 flex justify-start gap-6 items-end flex-col">
        {{-- Settings --}}
        <div class="relative w-8 h-8">
            <button id="{{ 'toggle_dashboard' . $id }}" data-id="{{ $id }}"
                class="toggle_dashboard  hover:bg-blue-400/20 w-full h-full absolute transition-colors group rounded-full flex justify-center items-center">
                <i class="ri-more-2-fill text-lg cursor-pointer transition-colors group-hover:text-blue-400"></i>
            </button>

            <div id="{{ 'dashboard_setting' . $id }}" data-id="{{ $id }}"
                class="dashboard_setting absolute z-30 hidden w-[20rem] h-fit rounded-3xl white_shadow bg-black right-0 top-0 overflow-hidden">


                
                <form action="{{ route('jobs.destroy', $id) }}" method="post">
                    @csrf
                    @method("DELETE")
                    
                    <button data-id="{{ $id }}" class="flex items-center gap-1.5 w-full hover:bg-[#141313c1] p-4 transition-colors cursor-pointer">
                        <i class="ri-delete-bin-6-line text-red-600"></i>
                        <h3 class="text-red-600">Delete</h3>
                    </button>
        
                </form>

                <a data-id="{{ $id }}" href="{{ route('jobs.edit', $id) }}"
                    class="flex items-center gap-1.5 w-full hover:bg-[#141313c1] p-4 transition-colors cursor-pointer">

                    <i class="ri-edit-line"></i>
                    <h3>Edit</h3>

                </a>
                <div>
                    <a data-id="{{ $id }}" href="{{ route('jobs.show', $id) }}"
                        class="flex items-center gap-1.5 w-full hover:bg-[#141313c1] p-4 transition-colors cursor-pointer">
                        <i class="ri-edit-line"></i>
                        <h3>Show</h3>
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toggleButtons = document.querySelectorAll(".toggle_dashboard");
                const dashboards = document.querySelectorAll(".dashboard_setting");


                document.addEventListener("click", function(event) {
                    let isButton = false;

                    toggleButtons.forEach(btn => {
                        if (btn.contains(event.target)) {
                            isButton = true;
                            const id = btn.getAttribute("data-id");
                            const dashboard = document.querySelector(`#dashboard_setting${id}`);

                            // إغلاق جميع القوائم قبل فتح الجديدة
                            dashboards.forEach(d => d.classList.add("hidden"));

                            // تبديل ظهور القائمة المحددة
                            dashboard.classList.toggle("hidden");
                        }
                    });

                    if (!isButton) {
                        dashboards.forEach(d => d.classList.add("hidden"));
                    }
                });
            });
        </script>



        {{-- tags --}}
        <div class="flex justify-start items-center gap-2 flex-wrap">

            @foreach ($tags as $tag)
                <x-tag class="base">{{ $tag->name }}</x-tag>
            @endforeach
        </div>


    </div>
</div>
