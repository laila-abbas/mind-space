<section class="space-y-6">
    <x-section-header description="{{ __('settings.preferences_desc') }}">
        {{ __('settings.preferences') }}
    </x-section-header>

    <div x-data="{}" class='ml-2'>
        <div class="mt-4 mb-4">
            <div class="flex items-center gap-2 mb-2">
                <x-lucide-languages class="w-5 h-5 text-text-muted" />
                <span>{{ __('settings.language') }}</span>
            </div>

            <div class="inline-flex rounded-lg border border-border-default overflow-hidden">
                <button
                    @click="$store.locale.set('en')"
                    class="px-4 py-2 text-sm transition cursor-pointer"
                    :class="$store.locale.current === 'en'
                        ? 'bg-[var(--color-brand-soft)] text-text-strong'
                        : 'text-text-muted hover:bg-bg-muted'"
                >
                    English
                </button>

                <button
                    @click="$store.locale.set('ar')"
                    class="px-4 py-2 text-sm transition cursor-pointer"
                    :class="$store.locale.current === 'ar'
                        ? 'bg-[var(--color-brand-soft)] text-text-strong'
                        : 'text-text-muted hover:bg-bg-muted'"
                >
                    العربية
                </button>
            </div>
        </div>
        
        <label class="flex items-center gap-8 py-3">
            <div class="flex items-center gap-2">
                <x-lucide-sun x-show="$store.theme.mode === 'dark'" class="w-5 h-5 text-yellow-500" />
                <x-lucide-moon x-show="$store.theme.mode !== 'dark'" class="w-5 h-5 text-text-muted" />
                <span>{{ __('settings.dark_mode') }}</span>
            </div>

            <button
                @click="$store.theme.toggleDark()"
                class="w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-600 relative transition cursor-pointer"
            >
                <span
                    class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition transform"
                    :class="{ 'translate-x-6': $store.theme.mode === 'dark' }"
                ></span>
            </button>
        </label>

        <div class="relative mt-4">
            <div class="flex items-center gap-2 mb-2">
                <x-lucide-palette class="w-5 h-5 text-text-muted" />
                <span>{{ __('settings.theme') }}</span>
            </div>
            <div
                class="absolute left-0 top-9/16 -translate-y-1/2
                    h-33 w-6
                    bg-gradient-to-r from-[var(--color-bg-page)] to-transparent
                    pointer-events-none">
            </div>

            <div
                class="absolute right-0 top-9/16 -translate-y-1/2
                    h-33 w-6
                    bg-gradient-to-l from-[var(--color-bg-page)] to-transparent
                    pointer-events-none">
            </div>

            <div
                class="flex gap-4 overflow-x-auto snap-x snap-mandatory p-3"
                style="scrollbar-width: none;"
            >
                <x-theme-card theme="default" label="{{ __('settings.default') }}" color1="#c2e0cb" color2="#5e9e6c" />

                <x-theme-card theme="parchment" label="{{ __('settings.parchment') }}" color1="#c4b49a" color2="#7a5a3a" />

                <x-theme-card theme="ocean-light" label="{{ __('settings.ocean_light') }}" color1="#7dd3fc" color2="#0284c7" />

                <x-theme-card theme="sunset-light" label="{{ __('settings.sunset_light') }}" color1="#fca5a5" color2="#dc2626" />
                
                <x-theme-card theme="woodland" label="{{ __('settings.woodland') }}" color1="#8b5e3c" color2="#6d4c33" />

                <x-theme-card theme="midnight" label="{{ __('settings.midnight') }}" color1="#38bdf8" color2="#0ea5e9" />

                <x-theme-card theme="lavender" label="{{ __('settings.lavender') }}" color1="#818cf8" color2="#4f46e5" />

                <x-theme-card theme="cyberpunk" label="{{ __('settings.cyberpunk') }}" color1="#ff00ff" color2="#00ff9f" />

                <x-theme-card theme="espresso" label="{{ __('settings.espresso') }}" color1="#d2b48c" color2="#8d6e63" />
            </div>
        </div>
    </div>
</section>
