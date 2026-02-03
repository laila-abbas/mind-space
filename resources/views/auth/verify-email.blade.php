<x-layout>
    <x-section-card center class='text-center max-w-xl'>
        
        <h1 class="text-xl font-semibold mb-4">Verify your email address</h1>

        <p class="text-text-muted mb-6">
            Thanks for signing up! Before getting started, please verify your email address
            by clicking on the link we just emailed to you.
        </p>

        <x-alert  
            message="A new verification link has been sent to your email address." 
            :show="session('status') === 'verification-link-sent'" 
        />

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-forms.button>Resend Verification Email</x-forms.button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="text-sm text-text-subtle hover:text-text-strong underline cursor-pointer"
                >
                    Log out
                </button>
            </form>
        </div>

    </x-section-card>
</x-layout>
