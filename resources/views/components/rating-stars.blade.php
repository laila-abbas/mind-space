@props(['rating' => 0])

@php
    $rating = $rating ?? 0;
    $fullStars = floor($rating);
    $hasHalfStar = ($rating - $fullStars) >= 0.5;
    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
@endphp

<span class="flex items-center gap-0.5 text-yellow-500">
    @for ($i = 0; $i < $fullStars; $i++)
        <x-lucide-star class="w-4 h-4 fill-current" />
    @endfor

    @if ($hasHalfStar) {{-- two stars stacked --}}
        <span class="relative w-4 h-4">
            <x-lucide-star class="w-4 h-4" />
            <span class="absolute inset-0 overflow-hidden w-1/2">
                <x-lucide-star class="w-4 h-4 fill-current" />
            </span>
        </span>
    @endif

    @for ($i = 0; $i < $emptyStars; $i++)
        <x-lucide-star class="w-4 h-4" />
    @endfor
</span>