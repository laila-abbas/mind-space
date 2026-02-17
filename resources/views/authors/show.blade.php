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

                <p class="mt-4 text-sm text-text-muted">{{ trans_choice('author.book_count', $author->books->count(), ['count' => $author->books->count()]) }} {{ __('author.published') }}</p>

            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-6 text-center md:text-start">{{ __('author.books') }}</h2>

            @if($author->books->isEmpty())
                <p class="text-text-muted">{{ __('author.no_books_yet') }}</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    @foreach($author->books as $book)
                        <div class="bg-bg-surface p-6 rounded-xl border border-border-soft shadow-sm">

                            <h3 class="font-semibold mb-2">{{ $book->title }}</h3>

                            @if($book->pivot->role)
                                <span class="text-xs bg-bg-muted px-2 py-1 rounded-full text-text-muted">
                                    {{ ucfirst($book->pivot->role) }}
                                </span>
                            @endif

                        </div>
                    @endforeach

                </div>
            @endif
        </div>

    </div>
</x-layout>
