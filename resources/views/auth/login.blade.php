<x-layout>
    
    <x-page-heading>{{ __('auth.welcome_back') }}</x-page-heading>
    
    <x-forms.form 
        method='POST' 
        action="{{ route('login.store') }}" 
        x-data="{ email: '' }"
    >
    
        <x-forms.input 
            label="{{ __('auth.email') }}" 
            name='email' 
            type='email' 
            x-model="email" 
            required 
        />

        <x-forms.input 
            label="{{ __('passwords.password') }}" 
            name='password' 
            type='password' 
            required
        />

        <div class="flex justify-end -mt-2">
            <a :href="`{{ route('password.request') }}?email=${encodeURIComponent(email)}`"
                class="text-sm text-text-muted transition hover:text-text-main hover:underline">
                {{ __('passwords.forgot_password') }}
            </a>
        </div>

        <x-forms.button>{{ __('auth.login') }}</x-forms.button>

    </x-forms.form>
</x-layout>