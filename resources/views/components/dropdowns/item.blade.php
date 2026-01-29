@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-2 px-4 py-2 text-sm font-medium text-text-700 hover:bg-primary/35 hover:text-secondary-600 rounded-lg hover:bg-primary transition-colors duration-200']) }}>
    @if (isset($icon))
        <div class="w-4 h-4">
            {{ $icon }}
        </div>
    @endif
    
    <span class="flex-1 text-sm font-medium">
        {{ $slot }}
    </span>
</a>