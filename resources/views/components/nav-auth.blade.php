@props(['mobile' => false])

@auth
    @if($mobile)
        <a 
            href="{{ route('profile.edit') }}" 
            class="flex items-center gap-2 px-4 py-2 rounded-lg text-text-main hover:bg-brand-hover hover:text-bg-surface transition text-start"
        >
            <x-lucide-settings class="w-5 h-5"/>
            <span>{{ __('home.settings') }}</span>
        </a>

        @can('submit book for publishing')
            <a 
                href="/books/create" 
                class="px-4 py-2 rounded-lg text-text-main hover:bg-brand-hover hover:text-bg-surface transition text-start"
            >
                {{ __('home.add_book') }}
            </a>
        @endcan

        <form method="POST" action="/logout">
            @csrf
            <button 
                type="submit"
                class="group flex items-center gap-2 w-full text-start px-4 py-2 rounded-lg text-text-main hover:bg-red-50 hover:text-red-500 transition cursor-pointer"
            >
                <x-lucide-log-out class="w-4 h-4"/>
                <span>{{ __('home.logout') }}</span>
            </button>
        </form>
    @else
        <x-dropdowns.dropdown>
            <x-slot name="trigger">
                <img 
                    src="{{ auth()->user()->avatar_url }}"
                    alt="{{ auth()->user()->first_name }}"
                    class="w-10 h-10 rounded-full object-cover bg-bg-muted transition-all duration-300 hover:scale-105 hover:ring-2 hover:ring-brand-accent-2/25"
                >
            </x-slot>

            <x-dropdowns.item href="{{ route('profile.edit') }}">
                <x-slot name="icon"><x-lucide-settings/></x-slot>
                {{ __('home.settings') }}
            </x-dropdowns.item>

            @can('submit book for publishing')
                <x-dropdowns.item href="/books/create">
                    {{ __('home.add_book') }}
                </x-dropdowns.item>
            @endcan

            <form method="POST" action="/logout">
                @csrf
                <button 
                    type="submit"
                    class="group flex items-center gap-2 w-full text-start px-4 py-2.5 text-sm font-medium text-text-muted hover:bg-red-50 hover:text-red-500 rounded-lg transition-all duration-200 cursor-pointer"
                >
                    <x-lucide-log-out class="w-4 h-4"/>
                    <span>{{ __('home.logout') }}</span>
                </button>
            </form>
        </x-dropdowns.dropdown>
    @endif
@endauth

@guest
    @if($mobile)
        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-brand-accent text-bg-surface font-semibold hover:bg-brand-accent-hover transition text-start">
            {{ __('home.signup') }}
        </a>
        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-brand-accent text-brand-accent font-semibold hover:bg-brand-accent hover:text-bg-surface transition text-start">
            {{ __('home.login') }}
        </a>
    @else
        <div class="flex gap-4 font-bold">
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-brand-accent text-bg-surface font-semibold hover:bg-brand-accent-hover transition">
                {{ __('home.signup') }}
            </a>
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-brand-accent text-brand-accent font-semibold hover:bg-brand-accent hover:text-bg-surface transition duration-300">
                {{ __('home.login') }}
            </a>
        </div>
    @endif
@endguest
