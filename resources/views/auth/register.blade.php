<x-layout>
    
    <x-page-heading>{{ __('auth.register') }}</x-page-heading>
    
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
            label="{{ __('auth.first_name') }}" 
            name='first_name' 
            asterisk 
            required 
        />

        <x-forms.input 
            label="{{ __('auth.last_name') }}"
            name='last_name' 
            placeholder="{{ __('auth.last_name_hint') }}" 
        />

        <x-forms.input 
            label="{{ __('auth.email') }}"
            name='email' 
            type='email' 
            asterisk 
            required 
        />

        <x-forms.input 
            label="{{ __('passwords.password') }}" 
            name='password' 
            type='password' 
            asterisk 
            strength 
            required
            x-model="password"
        />

        <div>
            <x-forms.input 
                label="{{ __('passwords.password_confirmation') }}"
                name='password_confirmation' 
                type='password' 
                asterisk 
                required 
                placeholder="{{ __('passwords.reenter_password') }}"
                x-model="passwordConfirmation" 
            />
            <x-forms.password-mismatch />
        </div>

        <x-forms.checkbox 
            name='is_author' 
            label="{{ __('auth.sign_up_author') }}"
            x-model='isAuthor' 
        />

        <div 
            x-show="isAuthor" 
            x-transition 
            class="space-y-4 mt-4"
        >

            <x-forms.input 
                label="{{ __('auth.pen_name') }}"
                name='pen_name' 
                placeholder="{{ __('auth.pen_name_hint') }}"
            />

            <x-forms.input 
                label="{{ __('auth.biography') }}" 
                name='biography' 
                type='textarea' 
                placeholder="{{ __('auth.biography_hint') }}"
            />

            <x-forms.input 
                label="{{ __('auth.personal_website') }}"
                name='website_url' 
                type='url' 
                placeholder="{{ __('auth.website_hint') }}"
            />
        </div>

        <x-forms.button
            x-bind:disabled="(password !== passwordConfirmation) 
                            || (password.length > 0 && password.length < 8)"
        >
            {{ __('auth.create_account') }}
        </x-forms.button>

    </x-forms.form>
</x-layout>