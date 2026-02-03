@props(['theme', 'label', 'color1', 'color2'])

<button
    @click="$store.theme.set('{{ $theme }}')"
    class="snap-start shrink-0 w-30 rounded-xl p-2 border border-[var(--color-border-soft)] hover:border-[var(--color-border-default)] transition hover:scale-[1.07] cursor-pointer"
    :class="{'ring-2 ring-[var(--color-brand-accent)]': $store.theme.mode === '{{ $theme }}'}"
>
    <div class="h-20 rounded-lg mb-3 flex">
        <div class="flex-1 rounded-l-lg" style="background-color: {{ $color1 }};"></div>
        <div class="flex-1 rounded-r-lg" style="background-color: {{ $color2 }};"></div>
    </div>

    <p class="text-sm font-medium">{{ $label }}</p>
</button>
