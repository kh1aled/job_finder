<section>
    <x-section-head>Update Password</x-section-head>

    <header>
        <p class="mt-1 text-sm text-gray-400 text-center">
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <x-form-fields>
            <x-input-label for="current_password" :value="__('Current Password')" />

            <x-input-form id="current_password" type="password" name="current_password" 
                placeholder="Enter your current password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('current_password')" class="mt-1" />
        </x-form-fields>

        <!-- New Password -->
        <x-form-fields>
            <x-input-label for="password" :value="__('New Password')" />

            <x-input-form id="password" type="password" name="password" 
                placeholder="Enter your new password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </x-form-fields>

        <!-- Confirm Password -->
        <x-form-fields>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input-form id="password_confirmation" type="password" name="password_confirmation" 
                placeholder="Confirm your new password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </x-form-fields>

        <div class="flex flex-col items-center justify-center gap-4 mt-4">
            <x-primary-button class="px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 transition">
                {{ __('Update') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-500 font-medium mt-2">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
