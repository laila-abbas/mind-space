@props(['rating', 'ratingCount'])

<p {{ $attributes }}>
    <x-rating-stars :rating="$rating" />
    <span class="text-sm text-text-muted ml-1">{{ $rating }} ({{ trans_choice('book.ratings', $ratingCount, ['count' => $ratingCount]) }})</span>
</p>