<x-app-layout>
    <x-section-head>Update Job</x-section-head>

    <form class="mb-6 space-y-6" method="POST" action="{{ route('jobs.update', $job->id) }}" id="edit_tag_form"
        enctype="multipart/form-data" onkeydown="if(event.key === 'Enter'){ event.preventDefault(); }">
        @csrf
        @method('PATCH')

        {{-- Title --}}
        <x-form-fields>
            <x-input-label for="title" :value="__('Title')" />
            <x-input-form id="title" type="text" name="title" :value="old('title', $job->title)" required autofocus
                autocomplete="title" placeholder="Job title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </x-form-fields>

        {{-- Salary --}}
        <x-form-fields>
            <x-input-label for="salary" :value="__('Salary')" />
            <x-input-form id="salary" type="number" name="salary" :value="old('salary', $job->salary)" required
                autocomplete="salary" placeholder="e.g. 50000" />
            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
        </x-form-fields>

        {{-- Location --}}
        <x-form-fields>
            <x-input-label for="location" :value="__('Location')" />
            <x-input-form id="location" type="text" name="location" :value="old('location', $job->location)" required
                autocomplete="location" placeholder="City, Country" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </x-form-fields>

        {{-- Description --}}
        <x-form-fields>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" required
                class="bg-white/5 border border-white/10 px-5 py-2 w-full rounded-xl max-w-xl min-h-[120px] resize-none"
                placeholder="Enter job description...">{{ old('description', $job->description) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </x-form-fields>

        {{-- Schedule --}}
        <x-form-fields>
            <x-input-label for="schedule" :value="__('Schedule')" />
            <x-select-form name="schedule" id="schedule" required>
                <x-option-form value="Full Time" :selected="old('schedule', $job->schedule) === 'Full Time'">Full Time</x-option-form>
                <x-option-form value="Part Time" :selected="old('schedule', $job->schedule) === 'Part Time'">Part Time</x-option-form>
            </x-select-form>
            <x-input-error :messages="$errors->get('schedule')" class="mt-2" />
        </x-form-fields>

        {{-- Tags --}}
        <x-form-fields>
            <x-input-label for="tags" :value="__('Tags')" />
            <x-edit-tags-form :tags="old('tags', $tags)" />
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
        </x-form-fields>

        {{-- Job Image --}}
        <x-form-fields class="justify-center items-center">
            <x-input-label for="avatar" :value="__('Job Image')" />

            <div
                class="w-full max-w-xl rounded-xl p-6 border border-dashed border-white/20 flex flex-col items-center justify-center">

                {{-- Upload placeholder --}}
                <div id="image_upload_from_update" class="{{ $job->avatar ? 'hidden' : 'block' }} mt-3">
                    <x-label-button-primary for="avatar_from_update" type="button">Upload Image</x-label-button-primary>
                </div>

                {{-- Preview & Update/Delete --}}
                <div id="image_update_from_update"
                    class="{{ $job->avatar ? 'flex' : 'hidden' }} flex-col items-center mt-3 gap-3">
                    <img id="image_from_update" src="{{ $job->avatar ? asset('/storage/posts/' . $job->avatar) : '' }}"
                        alt="Job Image Preview" class="w-24 h-24 rounded-xl object-cover">
                    <div class="flex gap-3">
                        <x-label-button-primary for="avatar_from_update" type="button">Update</x-label-button-primary>
                        <x-danger-button type="button" id="delete_image_from_update">Delete</x-danger-button>
                    </div>
                </div>
            </div>

            <input type="file" name="avatar" id="avatar_from_update" class="hidden" accept="image/*">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </x-form-fields>

        {{-- Submit --}}
        <div class="flex justify-end mt-4">
            <x-primary-button>{{ __('Update Job') }}</x-primary-button>
        </div>
    </form>

    {{-- JS for live image preview --}}
    <script>
        const avatarInput = document.getElementById('avatar_from_update');
        const uploadDiv = document.getElementById('image_upload_from_update');
        const updateDiv = document.getElementById('image_update_from_update');
        const previewImg = document.getElementById('image_from_update');
        const deleteBtn = document.getElementById('delete_image_from_update');

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