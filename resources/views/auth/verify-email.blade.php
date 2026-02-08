<x-layout>
    <x-section-card center class='text-center max-w-xl'>
        
        <h1 class="text-xl font-semibold mb-4">{{ __('auth.verify_email') }}</h1>

        <p class="text-text-muted mb-6">{{ __('auth.verify_email_notice') }}</p>

        <x-alert  
            message="{{ __('auth.verification_link_sent') }}" 
            :show="session('status') === 'verification-link-sent'" 
        />

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-forms.button>{{ __('auth.resend_verification') }}</x-forms.button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="text-sm text-text-subtle hover:text-text-strong underline cursor-pointer"
                >
                    {{ __('home.logout') }}
                </button>
            </form>
        </div>

    </x-section-card>
</x-layout>
