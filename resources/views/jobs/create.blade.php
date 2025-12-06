<x-app-layout>
    <x-section-head>Create New Job</x-section-head>

    <form class="mb-6 space-y-6" method="POST" action="{{ route('jobs.store') }}" id="tag_form" enctype="multipart/form-data"
        onkeydown="if(event.key === 'Enter'){ event.preventDefault(); }">
        @csrf

        {{-- Title --}}
        <x-form-fields>
            <x-input-label for="title" :value="__('Title')" />
            <x-input-form id="title" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </x-form-fields>

        {{-- Salary --}}
        <x-form-fields>
            <x-input-label for="salary" :value="__('Salary')" />
            <x-input-form id="salary" type="number" name="salary" :value="old('salary')" required autocomplete="salary" />
            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
        </x-form-fields>

        {{-- Location --}}
        <x-form-fields>
            <x-input-label for="location" :value="__('Location')" />
            <x-input-form id="location" type="text" name="location" :value="old('location')" required autocomplete="location" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </x-form-fields>

        {{-- Description --}}
        <x-form-fields>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" required
                      class="bg-white/5 border border-white/10 px-5 py-2 w-full rounded-xl max-w-xl min-h-[120px] resize-none"
                      placeholder="Enter job description...">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </x-form-fields>

        {{-- Schedule --}}
        <x-form-fields>
            <x-input-label for="schedule" :value="__('Schedule')" />
            <x-select-form name="schedule" id="schedule" required>
                <x-option-form value="Full Time" :selected="old('schedule') === 'Full Time'">Full Time</x-option-form>
                <x-option-form value="Part Time" :selected="old('schedule') === 'Part Time'">Part Time</x-option-form>
            </x-select-form>
            <x-input-error :messages="$errors->get('schedule')" class="mt-2" />
        </x-form-fields>

        {{-- Tags --}}
        <x-form-fields>
            <x-input-label for="tags" :value="__('Tags')" />
            <x-tags-form :old-tags="old('tags')" />
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
        </x-form-fields>

        {{-- Job Image --}}
        <x-form-fields class="justify-center items-center">
            <x-input-label for="avatar" :value="__('Job Image')" />
            <div class="w-full max-w-xl rounded-xl p-6 border border-dashed border-white/20 flex flex-col items-center justify-center">
                
                {{-- Upload placeholder --}}
                <div id="image_upload_from_create" class="block mt-3">
                    <x-label-button-primary for="avatar" type="button">Upload Image</x-label-button-primary>
                </div>

                {{-- Preview & Update/Delete --}}
                <div id="image_update_from_create" class="hidden flex flex-col items-center mt-3 gap-3">
                    <img id="image_from_create" src="" alt="Job Image Preview" class="w-24 h-24 rounded-xl object-cover">
                    <div class="flex gap-3">
                        <x-label-button-primary for="avatar" type="button">Update</x-label-button-primary>
                        <x-danger-button type="button" id="delete_image_from_create">Delete</x-danger-button>
                    </div>
                </div>
            </div>

            <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </x-form-fields>

        {{-- Submit --}}
        <div class="flex justify-end mt-4">
            <x-primary-button>{{ __('Create Job') }}</x-primary-button>
        </div>
    </form>

    {{-- Optional JS for live image preview --}}
    <script>
        const avatarInput = document.getElementById('avatar');
        const uploadDiv = document.getElementById('image_upload_from_create');
        const updateDiv = document.getElementById('image_update_from_create');
        const previewImg = document.getElementById('image_from_create');
        const deleteBtn = document.getElementById('delete_image_from_create');

        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    uploadDiv.classList.add('hidden');
                    updateDiv.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        deleteBtn.addEventListener('click', function() {
            avatarInput.value = '';
            previewImg.src = '';
            updateDiv.classList.add('hidden');
            uploadDiv.classList.remove('hidden');
        });
    </script>
</x-app-layout>
