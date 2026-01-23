<x-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg border border-primary text-center">
            <h1 class="text-xl font-semibold mb-4">
                Verify your email address
            </h1>

            <p class="text-gray-600 mb-6">
                Thanks for signing up! Before getting started, please verify your email address
                by clicking on the link we just emailed to you.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <x-forms.button class="w-full">
                        Resend Verification Email
                    </x-forms.button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm text-gray-500 hover:text-gray-700 underline"
                    >
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
