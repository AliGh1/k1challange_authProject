<x-master-layout>

    <x-slot name="title">
        Verify Phone Number
    </x-slot>

    <x-auth-card>
        <x-slot name="title">
            Verify Phone Number
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your phone number by type code number we just send sms to you? If you didn't receive the sms, we will gladly send you another.
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <form method="POST" action="{{ route('auth.verify-phone') }}">
        @csrf

        <!-- Code -->
            <div>
                <x-label for="code" :value="'Code'" />

                <x-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus />
            </div>
            <div>
                <div class="mt-4">
                    <x-button>
                        Submit
                    </x-button>
                </div>
            </div>
        </form>
        <form method="POST" action="{{ route('auth.verify-phone.resend') }}">
            @csrf

            <div>
                <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-purple-100 border border-purple-800 rounded-md font-semibold text-xs text-purple-800 uppercase tracking-widest hover:bg-purple-400 active:bg-purple-500 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Resend SMS Code
                </button>
            </div>
        </form>

    </x-auth-card>
</x-master-layout>
