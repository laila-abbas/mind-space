<section class="space-y-6">
    
    <x-section-header description="{{ __('passwords.password_security_hint') }}">
        {{ __('settings.security') }}
    </x-section-header>

    <x-forms.form 
        method="PATCH" 
        action="{{ route('profile.updatePassword') }}" 
        class="max-w-full"
        x-data="{ 
                password: '',
                passwordConfirmation: ''
            }"
    >
        <div class="space-y-6">
            <x-forms.input 
                label="{{ __('passwords.current_password') }}" 
                name="current_password" 
                type="password" 
                autocomplete="current-password"
                class="max-w-lg"
                :errorBag="'updatePassword'"
                required 
            />

            <x-forms.input 
                label="{{ __('passwords.new_password') }}" 
                name="password" 
                type="password" 
                autocomplete="new-password"
                class="max-w-lg"
                strength
                x-model="password"
                :errorBag="'updatePassword'" 
                required 
            />

            <div>
                <x-forms.input 
                    label="{{ __('passwords.password_confirmation') }}" 
                    name="password_confirmation" 
                    type="password" 
                    autocomplete="new-password"
                    class="max-w-lg"
                    x-model="passwordConfirmation" 
                    :errorBag="'updatePassword'" 
                    required
                    placeholder="{{ __('passwords.reenter_password') }}"
                />

                <x-forms.password-mismatch />
            </div>
        </div>

        <div class="flex pt-4">
        <div class="flex items-center gap-4 pt-4">
            <x-forms.button 
                x-bind:disabled="(password !== passwordConfirmation) 
                                || (password.length > 0 && password.length < 8)" 
                class="px-6 py-3">
                {{ __('passwords.update_password') }}
            </x-forms.button>
        </div>
        </div>
    </x-forms.form>
</section>