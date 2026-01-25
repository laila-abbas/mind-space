<x-layout>
    <x-auth-card>
            
        <h1 class="text-xl font-semibold mb-6 text-center">Reset your password</h1>

        <x-alert />

        <x-forms.form 
            method="POST" 
            action="{{ route('password.update') }}"
            x-data="{ 
                password: '',
                passwordConfirmation: ''
            }"
        >
            
            <input 
                type="hidden" 
                name="token" 
                value="{{ request()->route('token') }}"
            />
            
            <x-forms.input 
                label="Email" 
                name="email" 
                type="email" 
                :value="request('email')" 
                required 
            />

            <x-forms.input 
                label="New Password" 
                name="password" 
                type="password" 
                required 
                strength
                x-model="password" 
            />

            <div>
                <x-forms.input 
                    label="Confirm Password" 
                    name="password_confirmation" 
                    type="password" 
                    required 
                    x-model="passwordConfirmation"
                />

                <p
                    x-show="password && passwordConfirmation && password !== passwordConfirmation"
                    class="text-sm text-red-500 mt-1 ml-3"
                >
                    Passwords do not match
                </p>
            </div>
            
            <x-forms.button 
                x-bind:disabled="(password && passwordConfirmation && password !== passwordConfirmation) 
                                || (password.length && password.length < 8)"
            >
                Reset Password
            </x-forms.button>

        </x-forms.form>
    </x-auth-card>
</x-layout>
