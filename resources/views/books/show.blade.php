@props(['book'])

<x-layout>
    <div class="max-w-6xl mx-auto p-6">

        <div class="flex flex-col sm:flex-row gap-6 mb-8">
            <div class="w-48 h-72 shadow">
                <img src="{{ $book->coverImage }}" class="w-full h-full rounded-xl object-cover">
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
                <p class="text-sm text-text-muted mt-1">
                    {{ __('book.by') }} {{ $book->authors->pluck('display_name')->join(', ') }}
                </p>
                <p class="mt-4">{{ $book->description }}</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($book->categories as $category)
                        <x-chip>{{ $category->name }}</x-chip>
                    @endforeach
                </div>
            </div>
        </div>

        <div x-data="{ openEdition: null }" class="space-y-2">

            @foreach($book->publishedEditions as $index => $edition)
                <div class="border-b border-brand">
                    <button 
                        @click="openEdition === {{ $edition->id }} ? openEdition = null : openEdition = {{ $edition->id }}"
                        class="w-full flex justify-between items-center px-4 py-3 transition duration-300 hover:bg-brand-hover/10 cursor-pointer"
                    >
                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4">
                            <span class="font-semibold">{{ $edition->display_title }}</span>
                            <span class="text-sm text-text-muted">{{ $edition->published_at->format('M j, Y') }}</span>
                            <span class="text-sm text-text-muted">{{ $edition->language }}</span>
                            <span class="text-sm text-text-muted">{{ $edition->publishingHouse->name }}</span>  
                            <x-book-rating :rating="$book->rating" :rating-count="$book->ratingCount" class="flex gap-2" />
                        </div>
                        <x-lucide-chevron-down 
                            :class="{'rotate-180': openEdition === {{ $edition->id }}}"
                            class="w-5 h-5 transition-transform" 
                        />
                    </button>

                    <div x-show="openEdition === {{ $edition->id }}" x-cloak class="px-4 py-3 border-t border-brand">
                        
                        @if($edition->edition_description)
                            <p class="mb-4 text-sm text-text-muted">{{ $edition->edition_description }}</p>
                        @endif
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($edition->formats as $format)
                                <div class="border border-brand shadow-sm dark:shadow-black/20 rounded-xl p-4 flex flex-col items-center text-center">
                                    <div class="w-32 h-48 rounded-xl shadow mb-2">
                                        <img src="{{ $format->cover_image }}" class="rounded-xl w-full h-full object-cover">
                                    </div>
                                    <h4 class="font-semibold">{{ ucfirst($format->format) }}</h4>
                                    <p class="text-sm text-text-muted">{{ $format->language }}</p>
                                    @if($format->pages)
                                        <p class="text-sm">{{ trans_choice('book.pages', $format->pages, ['count' => $format->pages]) }}</p>
                                    @endif
                                    @if($format->stock !== null)
                                        <p class="text-sm text-text-muted">{{ $format->stock }} {{ __('book.in_stock') }}</p>
                                    @endif
                                    <p class="mt-1 font-semibold">
                                        @if($format->price > 0)
                                            ${{ number_format($format->price, 2) }}
                                        @else
                                            <span class="text-green-600 font-bold">{{ __('book.free') }}</span>
                                        @endif
                                    </p>
                                    <button class="mt-2 px-4 py-1 bg-brand text-white rounded hover:bg-brand-hover transition">
                                        Buy / Download
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-layout>