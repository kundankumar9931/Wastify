<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h1 style="font-size: 2rem; font-weight: bold; color: #1b5e20;">Wastify</h1>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thank you for signing up! We have emailed you a 6-digit OTP. Please enter it below to verify your email address.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new OTP has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <div>
                <x-label for="otp" value="{{ __('Enter 6-digit OTP') }}" />
                <x-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                <x-button>
                    {{ __('Verify OTP') }}
                </x-button>
            </div>
        </form>

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Resend OTP') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
