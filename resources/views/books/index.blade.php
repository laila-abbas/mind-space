<x-layout>
    <div class="py-12">
        <x-paginated-header 
            :title="__('home.books')" 
            subtitle="Your next great adventure is just a page turn away" 
            :collection="$books" 
        />
        
        @if($books->isEmpty())
            <div class="bg-bg-surface border border-border-soft rounded-2xl p-12 text-center text-text-muted space-y-4">
                <x-lucide-users class="w-12 h-12 mx-auto text-text-muted" />
                <p class="text-text-muted text-lg">{{ __('author.no_books') }}</p>
            </div>
        @else
            <x-filters-panel />
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($books as $book)
                    <x-book-card :book="$book" :show-role="false" />
                @endforeach
            </div>
            <div class="mt-10">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</x-layout>
{{-- 
chips
@if(request()->anyFilled(['language', 'format', 'price_max']))
    <div class="flex flex-wrap gap-2 mb-6">

        @if(request('language'))
            <a href="{{ request()->fullUrlWithQuery(['language' => null]) }}"
               class="px-3 py-1 rounded-full bg-bg-surface border text-sm">
                {{ request('language') }} ×
            </a>
        @endif

        @if(request('format'))
            <a href="{{ request()->fullUrlWithQuery(['format' => null]) }}"
               class="px-3 py-1 rounded-full bg-bg-surface border text-sm">
                {{ request('format') }} ×
            </a>
        @endif

        @if(request('price_max'))
            <a href="{{ request()->fullUrlWithQuery(['price_max' => null]) }}"
               class="px-3 py-1 rounded-full bg-bg-surface border text-sm">
                ≤ {{ request('price_max') }} ×
            </a>
        @endif

        <a href="{{ route('books.index') }}"
           class="text-sm text-brand-accent ml-2">
            Clear all
        </a>

    </div>
@endif --}}