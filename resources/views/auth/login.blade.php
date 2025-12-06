<x-app-layout>

    <x-section-head>Login</x-section-head>

    <form method="POST" action="{{ route('login') }}"
        class="max-w-xl mx-auto mt-10 bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-2xl space-y-6 shadow-lg">
        @csrf

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <x-form-fields>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-form id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </x-form-fields>

        <!-- Password -->
        <x-form-fields>
            <x-input-label for="password" :value="__('Password')" />
            <x-input-form id="password" type="password" name="password" required
                autocomplete="current-password" class="rounded-xl bg-white/10 border-white/20" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </x-form-fields>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <label for="remember_me" class="text-sm text-gray-300">{{ __('Remember me') }}</label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-white/70 hover:text-white underline transition">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-app-layout>
