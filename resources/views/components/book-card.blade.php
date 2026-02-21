@props(['book'])

@php
    $firstEdition = $book->editions()->published()->orderBy('published_at')->first();

    $coverImage = $firstEdition?->cover_image_path
        ? asset('storage/' . $firstEdition->cover_image_path)
        : asset('images/default_cover.jpg');
    
    $formats = $book->editions()->published()->pluck('format')->unique();
@endphp

<a href="{{ route('books.show', $book) }}"
   class="group bg-bg-surface rounded-2xl p-6 border border-brand shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-brand-hover transition-all duration-300">

    <div class="flex flex-col items-center text-center space-y-4">

        <div class="flex flex-wrap justify-center gap-2 mb-2">
            @foreach($book->categories->take(6) as $category)
                <span class="text-xs px-2 py-1 bg-brand-hover/20 text-text-subtle dark:bg-brand/10 dark:text-brand rounded-full">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <div class="w-32 h-48 rounded-xl overflow-hidden shadow-sm">
            <img src="{{ $coverImage }}" alt="{{ $book->title }} cover" class="w-full h-full object-cover">
        </div>

        <h3 class="text-lg font-semibold group-hover:text-brand-accent transition">
            {{ $book->title }}
        </h3>

        @if($showRole && $book->pivot->role)
            <span class="text-xs bg-bg-muted px-2 py-1 rounded-full text-text-muted">
                {{ ucfirst($book->pivot->role) }}
            </span>
        @endif

        <p class="text-sm font-semibold text-text-muted">
            {{ $book->authors->pluck('display_name')->take(2)->join(', ') }}
            @if($book->authors->count() > 2)
                +{{ $book->authors->count() - 2 }} more
            @endif
        </p>

        <p class="text-sm text-text-muted">
            {{ Str::limit($book->description, 50) }}
        </p>

        <div class="flex gap-2 mt-2">
            @if($formats->contains('hardcover'))
                <x-lucide-book class="w-4 h-4 text-text-muted" title="Hardcover" />
            @endif
            @if($formats->contains('paperback'))
                <x-lucide-book-open class="w-4 h-4 text-text-muted" title="Paperback" />
            @endif
            @if($formats->contains('e-book'))
                <x-lucide-tablet class="w-4 h-4 text-text-muted" title="E-Book" />
            @endif
            @if($formats->contains('audiobook'))
                <x-lucide-headphones class="w-4 h-4 text-text-muted" title="Audiobook" />
            @endif
        </div>

    </div>
</a>
