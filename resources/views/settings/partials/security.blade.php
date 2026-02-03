<section class="space-y-6">
    
    <x-section-header description="Ensure your account is using a long, random password to stay secure.">
        Security
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
                label="Current Password" 
                name="current_password" 
                type="password" 
                autocomplete="current-password"
                class="max-w-lg"
                :errorBag="'updatePassword'"
                required 
            />

            <x-forms.input 
                label="New Password" 
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
                    label="Confirm Password" 
                    name="password_confirmation" 
                    type="password" 
                    autocomplete="new-password"
                    class="max-w-lg"
                    x-model="passwordConfirmation" 
                    :errorBag="'updatePassword'" 
                    required
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
                Update Password
            </x-forms.button>
        </div>
        </div>
    </x-forms.form>
</section>