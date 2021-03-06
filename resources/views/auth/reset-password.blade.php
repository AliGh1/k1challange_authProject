<x-master-layout>

    <x-slot name="title">
        Reset Password
    </x-slot>

    <x-auth-card>
        <x-slot name="title">
            Reset Password
        </x-slot>

        @if (isset($status))
            <div class="font-medium text-sm text-green-600">
                {{ $status }}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
        @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="'Email'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Password'" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="'Confirm Password'" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Reset Password
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-master-layout>

