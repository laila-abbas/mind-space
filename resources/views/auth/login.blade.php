<x-layout>
    
    <x-page-heading>Welcome back!</x-page-heading>
    
    <x-forms.form 
        method='POST' 
        action="{{ route('login.store') }}" 
        x-data="{ email: '' }"
    >
    
        <x-forms.input 
            label='Email' 
            name='email' 
            type='email' 
            x-model="email" 
            required 
        />

        <x-forms.input 
            label='Password' 
            name='password' 
            type='password' 
            required
        />

        <div class="flex justify-end -mt-2">
            <a :href="`{{ route('password.request') }}?email=${encodeURIComponent(email)}`"
                class="text-sm text-text/70 transition hover:text-text hover:underline hover:text-text">
                Forgot password?
            </a>
        </div>

        <x-forms.button>Log In</x-forms.button>

    </x-forms.form>
</x-layout>