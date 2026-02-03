@props(['align' => 'right', 'width' => 'w-40']) {{-- alight for switching lang --}}

<div 
    x-data="{ open: false }" 
    class="relative"
    {{ $attributes }}
>
    <button @click="open = !open" class="flex items-center focus:outline-none cursor-pointer">
        {{ $trigger }}
    </button>

    <div 
        x-show="open" 
        @click.outside="open = false"
        x-transition
        class="absolute mt-2 {{ $align === 'right' ? 'right-0' : 'left-0' }} {{ $width }} bg-bg-surface rounded-xl shadow-2xl py-2 px-2 z-50"
    >
        {{ $slot }}
    </div>
</div>
