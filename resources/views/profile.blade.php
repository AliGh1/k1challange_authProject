<x-master-layout>

    <x-slot name="title">
        Profile
    </x-slot>

    <x-auth-card>
        <x-slot name="title">
            Profile
        </x-slot>

        @if (session('status'))
            <div class="font-medium text-sm text-green-600 p-4 bg-green-200 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('patch')

        <!-- First Name -->
            <div>
                <x-label for="first_name" :value="'First Name'" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $user->first_name)" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="'Last Name'" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-profile-piece :title="'Email'">{{ $user->email }}</x-profile-piece>
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" :value="'Phone Number'" />

                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" pattern="09(0[1-2]|1[0-9]|3[0-9]|2[0-1])[0-9]{3}[0-9]{4}" placeholder="09121234567" value="{{ old('phone', $user->phone) }}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Update
                </x-button>
            </div>
        </form>

        <hr class="mt-4 border-2 border-purple-100">

        <h5 class="mt-4 text-lg font-semibold text-purple-800">Change Password</h5>

        <form method="POST" action="{{ route('user.change', $user->id) }}">
            @csrf
            @method('patch')
            <!-- Current Password -->
            <div class="mt-4">
                <x-label for="current_password" :value="'Current Password'" />

                <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required />
            </div>

            <!-- New Password -->
            <div class="mt-4">
                <x-label for="password" :value="'New Password'" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm New Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="'Confirm New Password'" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Update Password
                </x-button>
            </div>
        </form>

        <hr class="mt-4 border-2 border-purple-100">

        <h5 class="mt-4 text-lg font-semibold text-red-600">Delete Account</h5>
        <p class="mt-2">Once you delete your account, there is no going back. Please be certain.</p>

        <form method="POST" action="{{ route('user.destroy', $user->id) }}">
            @csrf
            @method('delete')
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Password'" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Delete Account
                    </button>
                </div>
            </div>
        </form>

    </x-auth-card>

</x-master-layout>
