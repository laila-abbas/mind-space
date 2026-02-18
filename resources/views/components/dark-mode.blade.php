<button
    @click="$store.theme.toggleDark()"
    class="w-12 h-6 relative flex items-center justify-center transition cursor-pointer"
>
    <x-lucide-sun x-show="$store.theme.mode === 'dark'" class="w-5 h-5 text-yellow-500 absolute" />
    <x-lucide-moon x-show="$store.theme.mode !== 'dark'" class="w-5 h-5 text-text-muted absolute" />
</button>