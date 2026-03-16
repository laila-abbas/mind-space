<x-layout>
    <div class="py-12 space-y-12">

        <div class="flex flex-col md:flex-row items-center md:items-start gap-10">

            <img
                src="{{ $author->user->avatar_url }}"
                class="w-36 h-36 rounded-full object-cover ring-2 ring-brand-accent"
                alt="{{ $author->display_name }}"
            />

            <div class="flex flex-col items-center md:items-start max-w-2xl">

                <h1 class="text-4xl font-bold">{{ $author->display_name }}</h1>

                @if($author->website_url)
                    <a 
                        href="{{ $author->website_url }}"
                        target="_blank" {{-- open in a new tab --}}
                        rel="noopener noreferrer" {{-- prevent tabnabbing vulnerability --}}
                        class="inline-flex items-center gap-2 mt-4 text-brand-accent hover:underline"
                    >
                        <x-lucide-globe class="w-4 h-4" />
                        <span>{{ __('author.official_website') }}</span>
                    </a>
                @endif

                @if($author->biography)
                    <p class="mt-6 text-text-muted leading-relaxed">{{ $author->biography }}</p>
                @endif

                <p class="mt-4 text-sm text-text-muted">{{ trans_choice('author.book_count', $books->count(), ['count' => $books->count()]) }} {{ trans_choice('author.published', $author->books->count()) }}</p>

            </div>
        </div>

        <div>
            <x-paginated-header :title="__('author.books')" :collection="$books" />

            @if($books->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 bg-brand-soft/10 rounded-2xl border-2 border-dashed border-border-brand-soft">
                    <div class="p-4 rounded-full bg-bg-surface mb-4 shadow-sm">
                        <x-lucide-book-x class="w-10 h-10 text-brand-accent/30" />
                    </div>
                    <p class="text-text-muted font-medium text-lg">{{ __('author.no_books_yet') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($books as $book)
                        <x-book-card :book="$book" :show-role="true" />
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layout>
