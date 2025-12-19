<x-guest-layout>
    <div class="max-w-lg mx-auto">  
        <!-- MediBook Logo  -->
        <div class="text-center mb-10">
            <img src="{{ asset('images/medibook-logo.png') }}" alt="MediBook Logo" class="w-40 mx-auto">
            <h2 class="text-3xl font-bold text-center text-blue-700 mt-6">Welcome Back</h2>
            <p class="text-center text-gray-600 mt-2">Login to your MediBook account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                @if (Route::has('password.request'))
                    <div class="text-sm text-right mt-2">
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="mb-6 flex items-center">
                <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center mt-8">
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition text-lg w-full">
                    Login
                </button>
            </div>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">Register here</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>