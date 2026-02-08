<x-layout>
    <x-section-card center class='max-w-md'>
            
        <h1 class="text-xl font-semibold mb-6 text-center">{{ __('passwords.reset_your_password') }}</h1>

        <x-alert />

        <x-forms.form method="POST" action="{{ route('password.email') }}">  
            <x-forms.input 
                label="{{ __('auth.email') }}" 
                name="email" 
                type="email"
                required 
                :value="request('email')"
            />

            <x-forms.button>{{ __('passwords.send_reset_link') }}</x-forms.button>
        </x-forms.form>
    </x-section-card>
</x-layout>
