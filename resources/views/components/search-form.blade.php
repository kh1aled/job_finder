<section class="flex justify-center items-center flex-col">
    <h1 class="text-4xl font-bold">Let's Find You a Great Job</h1>

    <form class="mt-6 w-full text-center" id="searchForm" action="{{ route('jobs.search') }}" method="GET">
        <input type="text" name="query" id="searchInput" placeholder="web developer...."  value="{{ request('query') }}"
            class="bg-white/5 border-white/10 border text-start px-5 py-4 w-full rounded-xl max-w-xl mx-auto">
    </form>

    <script>
        let searchInput = document.getElementById("searchInput");
        let searchForm = document.getElementById("searchForm");

        searchInput.addEventListener("input", function() {
            if (searchInput.value.trim().length > 0) { 
                searchForm.submit();
            }else{
                window.location.href = "{{ route('jobs.index') }}";
            }
        });

        searchInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); 
                if (searchInput.value.trim().length > 0) { 
                    searchForm.submit();
                }
            }
        });
    </script>
</section>
