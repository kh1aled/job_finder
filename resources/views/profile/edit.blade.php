<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
            {{ __('Profile Settings') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
            Manage your account information, password, and delete your account if needed.
        </p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Update Profile Information --}}
            <div class="p-6 bg-white/5 shadow-lg sm:rounded-xl transition hover:shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-white">Update Profile Information</h3>
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="p-6 bg-white/5 shadow-lg sm:rounded-xl transition hover:shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-white">Update Password</h3>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="p-6 bg-white/5 shadow-lg sm:rounded-xl transition hover:shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-red-500">Delete Account</h3>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>