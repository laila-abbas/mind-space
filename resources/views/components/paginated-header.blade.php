@props(['title', 'subtitle' => null, 'collection', 'size' => 'lg'])

@php
    $sizes = [
        'sm' => 'text-xl md:text-2xl',
        'md' => 'text-2xl md:text-3xl',
        'lg' => 'text-3xl md:text-4xl',
    ];

    $titleSize = $sizes[$size] ?? $sizes['lg'];
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col md:flex-row items-center md:items-end justify-center md:justify-between mb-10 text-center md:text-left space-y-4 md:space-y-0']) }}>
    <div>
        <h1 class="{{ $titleSize }} font-bold text-center md:text-start tracking-tight">
            {{ $title }}
        </h1>
        @if($subtitle)
            <p class="text-text-subtle text-sm mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    
    @if($collection instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="text-sm text-text-subtle">
            @if($subtitle)
                {{ $collection->total() }} Total
            @else
                Showing {{ $collection->firstItem() }} to {{ $collection->lastItem() }} of {{ $collection->total() }}
            @endif
        </div>
    @endif
</div>