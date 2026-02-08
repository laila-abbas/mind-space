<x-layout>
    <div class="max-w-5xl mx-auto py-10 sm:px-6 lg:px-8 space-y-10">
        
        @if(session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 4000)" 
                x-transition.out.opacity.duration.1000ms>
                <x-alert />
            </div>
        @endif

         @if ($errors->updateProfileInformation->any())
            <x-alert 
                type="error" 
                message="{{ __('settings.account_update_error') }}" 
            />
        @endif

        @if ($errors->updatePassword->any())
            <x-alert 
                type="error" 
                message="{{ __('passwords.password_update_error') }}" 
            />
        @endif

        @if(auth()->check() && !auth()->user()->hasVerifiedEmail())
            <x-alert
                type="warning"
                message="{{ __('settings.email_unverified') }}"
            />
        @endif


        <x-section-card>
            @include('settings.partials.account-info')
        </x-section-card>

        <x-forms.divider />

        <x-section-card>
            @include('settings.partials.security')
        </x-section-card>

        <x-forms.divider />

        <x-section-card>
            @include('settings.partials.preferences')
        </x-section-card>

    </div>
</x-layout>