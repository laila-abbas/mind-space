<section class="space-y-6">
    <x-section-header description="Customize your experience by adjusting these settings.">
        Preferences
    </x-section-header>

    <div x-data>
        <label class="flex items-center gap-8 py-3">
            <div class="flex items-center gap-2">
                <x-lucide-moon class="w-5 h-5 text-text-muted" />
                <span>Dark Mode</span>
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
                <span>Theme</span>
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
                <x-theme-card theme="default" label="Default" color1="#c2e0cb" color2="#5e9e6c" />

                <x-theme-card theme="parchment" label="Parchment" color1="#c4b49a" color2="#7a5a3a" />

                <x-theme-card theme="ocean-light" label="Ocean" color1="#7dd3fc" color2="#0284c7" />

                <x-theme-card theme="sunset-light" label="Sunset" color1="#fca5a5" color2="#dc2626" />
                
                <x-theme-card theme="woodland" label="Woodland" color1="#8b5e3c" color2="#6d4c33" />

                <x-theme-card theme="midnight" label="Midnight" color1="#38bdf8" color2="#0ea5e9" />

                <x-theme-card theme="lavender" label="Lavender" color1="#818cf8" color2="#4f46e5" />

                <x-theme-card theme="cyberpunk" label="Cyberpunk" color1="#ff00ff" color2="#00ff9f" />

                <x-theme-card theme="espresso" label="Espresso" color1="#d2b48c" color2="#8d6e63" />
            </div>
        </div>
    </div>
</section>
