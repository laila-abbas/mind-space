@props(['mobile' => false])

@if(! $mobile)
    <x-dark-mode />
    @auth
        <x-dropdowns.dropdown>
            <x-slot name="trigger">
                <img src="{{ auth()->user()->avatar_url }}" class="w-10 h-10 rounded-full object-cover bg-bg-muted transition-all duration-300 hover:scale-105 hover:ring-2 hover:ring-brand-accent-2/25">
            </x-slot>

            <x-dropdowns.item href="{{ route('profile.edit') }}">
                <x-slot name="icon"><x-lucide-settings /></x-slot>
                {{ __('home.settings') }}
            </x-dropdowns.item>

            <x-logout :mobile="false" />
        </x-dropdowns.dropdown>
    @else
        <div class="flex gap-4 font-bold">
            <x-signup-login />
        </div>
    @endauth

@else
    @auth
        <div class="flex items-center gap-3 px-4 py-2">
            <img src="{{ auth()->user()->avatar_url }}" class="w-15 h-15 rounded-full ring-2 ring-brand-accent/40">
            <span class="font-medium">{{ auth()->user()->first_name }}</span>
            <x-dark-mode />
        </div>
    @endauth

    <div class="flex flex-col gap-1 border-b border-border-soft py-2">
        <h3 class="text-sm font-semibold text-text-muted uppercase">{{ __('home.navigation') }}</h3>
        <x-nav-tabs mobile />
    </div>

    @auth
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-text-main hover:bg-brand-hover hover:text-bg-surface transition text-start">
            <x-lucide-settings class="w-5 h-5"/>
            <span>{{ __('home.settings') }}</span>
        </a>

        <x-logout />
    @else
        <div class='flex border-b border-border-soft pt-2 pb-4'>
            <p>{{ __('settings.dark_mode') }}</p>
            <x-dark-mode />
        </div>

        <div class='flex flex-col gap-1 py-2'>
            <x-signup-login :center="true" />
        </div>
    @endauth
@endif