<x-master-layout>

    <x-slot name="title">
        Forget password
    </x-slot>

    <x-auth-card>
        <x-slot name="title">
            Forget password
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        @if (isset($status))
            <div class="font-medium text-sm text-green-600">
                {{ $status }}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="email" :value="'Email'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Email Password Reset Link
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-master-layout>
