 <div class="space-y-4">
    @forelse($reviews as $review)
        <div class="flex gap-4 p-4 rounded-xl bg-bg-surface border border-brand/50 shadow-md">
            <div class="w-12 h-12 rounded-full bg-brand/20">
                <img src="{{ $review->user->avatar_url }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold">
                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                        </p>
                        <div class="my-1">
                            <x-rating-stars :rating="$review->rating" />
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($review->created_at != $review->updated_at) 
                            <x-chip class="text-[10px]">Edited</x-chip>
                        @endif
                        <span class="text-[10px] text-text-strong uppercase">{{ $review->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                @if($review->review)
                    <p class="text-sm text-text-main mt-2 leading-snug">
                        {{ $review->review }}
                    </p>
                @endif
            </div>
        </div>
    @empty
        <p class="text-sm text-text-muted italic text-center py-4">
            No reviews yet.
        </p>
    @endforelse

    <div class="pt-4">
        {{ $reviews->links(data: ['scrollTo'=>false]) }}
    </div>
</div>