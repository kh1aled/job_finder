<x-app-layout>
    <x-section-head>Register</x-section-head>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
        class="max-w-xl mx-auto mt-10 bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-2xl space-y-6 shadow-lg">
        @csrf

        <!-- Name -->
        <x-form-fields>
            <x-input-label for="name" :value="__('Name')" />
            <x-input-form id="name" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </x-form-fields>

        <!-- Email -->
        <x-form-fields>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-form id="email" type="email" name="email" :value="old('email')" required
                autocomplete="username" class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </x-form-fields>

        <!-- Password -->
        <x-form-fields>
            <x-input-label for="password" :value="__('Password')" />
            <x-input-form id="password" type="password" name="password" required autocomplete="new-password"
                class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </x-form-fields>

        <!-- Confirm Password -->
        <x-form-fields>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-form id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </x-form-fields>

        <!-- Avatar Upload -->
        <x-form-fields class="flex flex-col items-center gap-4">

            <div class="w-40 h-40 rounded-full border border-dashed border-white/30 flex items-center justify-center relative overflow-hidden bg-white/5">
                <img id="avatar_preview" src="" alt="" class="hidden w-full h-full object-cover rounded-full">

                <label for="avatar"
                    class="cursor-pointer text-sm text-gray-300 bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded-xl transition">
                    Upload Avatar
                </label>
            </div>

            <input type="file" name="avatar" id="avatar" class="hidden">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </x-form-fields>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
                class="text-sm text-white/70 hover:text-white underline transition">
                Already registered?
            </a>

            <x-primary-button class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Preview uploaded avatar
        document.getElementById('avatar').addEventListener('change', function(e) {
            let img = document.getElementById('avatar_preview');
            img.src = URL.createObjectURL(e.target.files[0]);
            img.classList.remove('hidden');
        });
    </script>

</x-app-layout>