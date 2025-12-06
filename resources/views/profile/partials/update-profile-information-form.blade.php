<section class="max-w-3xl mx-auto space-y-6">
    <x-section-head>Profile Information</x-section-head>

    <p class="mt-1 text-sm text-gray-400 text-center">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    {{-- Form to send verification email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Update Profile Form --}}
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
        class="mt-6 space-y-6 p-6 rounded-xl shadow-md">
        @csrf
        @method('patch')

        <!-- Name -->
        <x-form-fields>
            <x-input-label for="name" :value="__('Name')" />
            <x-input-form id="name" type="text" name="name" :value="old('name', $user->name)" required autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </x-form-fields>

        <!-- Email -->
        <x-form-fields>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-form id="email" type="email" name="email" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-yellow-400 flex0start">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification"
                        class="underline text-sm hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-500">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </x-form-fields>

        <!-- Avatar Upload -->
        <x-form-fields class="justify-center items-center">
            <x-input-label for="avatar" :value="__('Avatar Image')" />

            <div
                class="w-full max-w-xl rounded-xl p-6 border border-white/20 border-dashed flex flex-col justify-center items-center gap-3">

                <div id="image_upload_from_update" class="block">
                    <x-label-button-primary for="avatar_from_update" type="button">
                        Choose Avatar
                    </x-label-button-primary>
                </div>

                <div id="image_update_from_update" class="hidden flex flex-col items-center gap-3">
                    <img id="image_from_update" src="{{ asset('/storage/images/' . $user->avatar) }}" alt="Avatar"
                        class="w-24 h-24 rounded-full object-cover shadow-md">

                    <div class="flex gap-3">
                        <x-label-button-primary for="avatar_from_update" type="button" id="avatar_update">
                            Update
                        </x-label-button-primary>
                        <x-danger-button type="button" id="delete_image_from_update">Delete</x-danger-button>
                    </div>
                </div>

            </div>

            <input type="file" name="avatar" id="avatar_from_update" class="hidden" accept="image/*">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
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
