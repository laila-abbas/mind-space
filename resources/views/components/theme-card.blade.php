@props(['theme', 'label', 'color1', 'color2'])

<button
    @click="$store.theme.set('{{ $theme }}')"
    class="snap-start shrink-0 w-30 rounded-xl p-2 border border-[var(--color-border-soft)] hover:border-[var(--color-border-default)] transition hover:scale-[1.07] cursor-pointer"
    :class="{'ring-2 ring-[var(--color-brand-accent)]': $store.theme.mode === '{{ $theme }}'}"
>
    <div class="h-20 mb-3 flex items-center justify-center relative">
        <div
            class="w-10 h-10 rounded-full shadow-sm"
            style="background-color: {{ $color2 }};"
        ></div>
        <div
            class="w-10 h-10 rounded-full shadow-sm -ms-3 "
            style="background-color: {{ $color1 }};"
        ></div>
    </div>


    <p class="text-sm font-medium">{{ $label }}</p>
</button>
