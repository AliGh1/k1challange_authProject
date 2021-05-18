<x-master-layout>

    <x-slot name="title">
        Login
    </x-slot>

    <x-auth-card>

        <x-slot name="title">
            Login
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" >
        @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="'Email'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Password'" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-link :value="'Forgot your password?'" href="{{ route('password.request') }}"/>

                <x-button class="ml-3">
                    Login
                </x-button>
            </div>

        </form>

    </x-auth-card>


</x-master-layout>
