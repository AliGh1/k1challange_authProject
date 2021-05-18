<x-master-layout>

    <x-slot name="title">
        Register
    </x-slot>

    <x-auth-card>

        <x-slot name="title">
            Register
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
        @csrf

            <!-- First Name -->
            <div>
                <x-label for="first_name" :value="'First Name'" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="'Last Name'" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="'Email'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" :value="'Phone Number'" />

                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" pattern="09(0[1-2]|1[0-9]|3[0-9]|2[0-1])[0-9]{3}[0-9]{4}" placeholder="09121234567" value="{{ old('phone') }}" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Password'" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="'Confirm Password'" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-link :value="'Already registered?'" href="{{ route('login') }}" />

                <x-button class="ml-4">
                    Register
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-master-layout>
