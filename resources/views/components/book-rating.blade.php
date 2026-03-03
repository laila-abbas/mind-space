@props(['rating', 'ratingCount'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <x-rating-stars :rating="$rating" class="flex gap-0.5" />
    
    <div class="flex items-center gap-1.5">
        <span class="font-bold text-sm text-text-main">
            {{ number_format($rating, 1) }}
        </span>

        <x-lucide-circle class="w-1 h-1 fill-current text-text-muted/30" />

        <span class="text-xs text-text-muted cursor-default">
            {{ trans_choice('book.ratings', $ratingCount, ['count' => $ratingCount]) }}
        </span>
    </div>
</div>