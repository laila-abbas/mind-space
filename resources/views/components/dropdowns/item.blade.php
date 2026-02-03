@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-2 px-4 py-2 text-sm font-medium text-text-muted hover:bg-brand-muted hover:text-brand-accent-2 rounded-lg transition-colors duration-200']) }}>
    @if (isset($icon))
        <div class="w-4 h-4 text-text-muted group-hover:text-brand-accent-2 transition-colors duration-200">
            {{ $icon }}
        </div>
    @endif
    
    <span class="flex-1 text-sm font-medium">
        {{ $slot }}
    </span>
</a>