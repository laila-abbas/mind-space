<x-layout>
    
    <x-page-heading>Register</x-page-heading>
    
    <x-alert type="error" />

    <x-forms.form 
        method='POST' 
        action="{{ route('register.store') }}" 
        x-data="{ 
            isAuthor: {{ old('is_author') ? 'true' : 'false' }},
            password: '',
            passwordConfirmation: ''
        }"
    >
    
        <x-forms.input 
            label='First Name' 
            name='first_name' 
            asterisk 
            required 
        />

        <x-forms.input 
            label='Last Name' 
            name='last_name' 
            placeholder="Last Name (Optional)" 
        />

        <x-forms.input 
            label='Email' 
            name='email' 
            type='email' 
            asterisk 
            required 
        />

        <x-forms.input 
            label='Password' 
            name='password' 
            type='password' 
            asterisk 
            strength 
            required
            x-model="password"
        />

        <div>
            <x-forms.input 
                label='Password Confirmation' 
                name='password_confirmation' 
                type='password' 
                asterisk 
                required 
                placeholder='Re-enter your password'
                x-model="passwordConfirmation" 
            />
            <x-forms.password-mismatch />
        </div>

        <x-forms.checkbox 
            name='is_author' 
            label='Sign up as an Author' 
            x-model='isAuthor' 
        />

        <div 
            x-show="isAuthor" 
            x-transition 
            class="space-y-4 mt-4"
        >

            <x-forms.input 
                label='Pen Name' 
                name='pen_name' 
                placeholder='How your name appears on books (Optional)' 
            />

            <x-forms.input 
                label='Biography' 
                name='biography' 
                type='textarea' 
                placeholder='Biography... (Optional)' 
            />

            <x-forms.input 
                label='Personal Website' 
                name='website_url' 
                type='url' 
                placeholder='https://... (Optional)' 
            />
        </div>

        <x-forms.button
            x-bind:disabled="(password !== passwordConfirmation) 
                            || (password.length > 0 && password.length < 8)"
        >
            Create Account
        </x-forms.button>

    </x-forms.form>
</x-layout>