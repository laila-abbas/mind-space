<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-gray-900">Security</h2>
        <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
    </header>

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
                />

                <p
                        x-show="password && passwordConfirmation && password !== passwordConfirmation"
                    class="text-sm text-red-500 mt-1 ml-3"
                >
                    Passwords do not match
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit"
                x-bind:disabled="(password !== passwordConfirmation) 
                                || (password.length > 0 && password.length < 8)" 
                class="px-6 py-3 bg-primary text-text rounded-xl font-bold hover:bg-secondary transition-all cursor-pointer">
                Update Password
            </button>
        </div>
    </x-forms.form>
</section>