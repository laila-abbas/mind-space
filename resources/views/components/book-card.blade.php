@props(['book'])

<a href="{{ route('books.show', $book) }}"
   class="group bg-bg-surface rounded-2xl p-6 border border-brand shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-brand-hover transition-all duration-300">

    <div class="flex flex-col items-center text-center space-y-4">

        <div class="flex flex-wrap justify-center gap-2 mb-2">
            @foreach($book->categories->take(6) as $category)
                <x-chip>{{ $category->name }}</x-chip>
            @endforeach
        </div>

        <div class="w-32 h-48 rounded-xl overflow-hidden shadow-sm">
            <img src="{{ $book->coverImage }}" class="w-full h-full object-cover">
        </div>

        <h3 class="text-lg font-semibold group-hover:text-brand-accent transition">
            {{ $book->title }}
        </h3>

        <x-book-rating :rating="$book->rating" :rating-count="$book->ratingCount" />

        @if($showRole && $book->pivot->role)
            <span class="text-xs bg-bg-muted px-2 py-1 rounded-full text-text-muted">
                {{ ucfirst($book->pivot->role) }}
            </span>
        @endif

        <p class="text-sm font-semibold text-text-muted">
            {{ $book->authors->pluck('display_name')->take(2)->join(', ') }}
            @if($book->authors->count() > 2)
                {{ trans_choice('book.more', $book->authors->count()-2, ['count' => $book->authors->count()-2]) }}
            @endif
        </p>

        <p class="text-sm text-text-muted">
            {{ Str::limit($book->description, 50) }}
        </p>

        <div class="flex gap-2 mt-2">
            @if($book->formats->contains('hardcover'))
                <x-lucide-book class="w-4 h-4 text-text-muted" title="{{ __('book.hardcover') }}" />
            @endif
            @if($book->formats->contains('paperback'))
                <x-lucide-book-open class="w-4 h-4 text-text-muted" title="{{ __('book.paperback') }}" />
            @endif
            @if($book->formats->contains('e-book'))
                <x-lucide-tablet class="w-4 h-4 text-text-muted" title="{{ __('book.ebook') }}" />
            @endif
            @if($book->formats->contains('audiobook'))
                <x-lucide-headphones class="w-4 h-4 text-text-muted" title="{{ __('book.audiobook') }}" />
            @endif
        </div>

    </div>
</a>
