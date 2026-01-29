<x-layout>
    <div class="max-w-5xl mx-auto py-10 sm:px-6 lg:px-8 space-y-10">
        
        @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 4000)" 
                x-transition.out.opacity.duration.1000ms>
                
                @if (session('status') === 'profile-updated')
                    <x-alert message="Account details updated successfully" />
                @elseif (session('status') === 'password-updated')
                    <x-alert message="Your password has been changed." />
                @elseif (session('status'))
                    <x-alert :message="session('status')" />
                @endif
            </div>
        @endif

        @if ($errors->updatePassword->any())
            <x-alert 
                type="error" 
                message="There were some problems updating your password. Please check the security section below." 
            />
        @endif

        @if(auth()->check() && !auth()->user()->hasVerifiedEmail())
            <x-alert
                type="warning"
                message="Your email address is unverified. Please check your inbox and verify your email to access all features."
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