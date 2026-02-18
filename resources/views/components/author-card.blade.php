@props(['author'])

<a href="{{ route('authors.show', $author) }}"
   class="group bg-bg-surface rounded-2xl p-6 border border-brand shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-brand-hover transition-all duration-300">

    <div class="flex flex-col items-center text-center space-y-4">

        <div>
            <img
                src="{{ $author->user->avatar_url }}"
                alt="{{ $author->display_name }}"
                class="w-24 h-24 rounded-full object-cover group-hover:ring-2 group-hover:ring-brand-accent/40 transition-all duration-300"
            >
        </div>

        <h3 class="text-lg font-semibold group-hover:text-brand-accent transition">
            {{ $author->display_name }}
        </h3>

        <p class="text-sm text-text-muted">
            {{ Str::limit($author->biography, 50) }}
        </p>

        <p class="text-sm text-text-muted">
            {{ trans_choice('author.book_count', $author->published_books_count, ['count' => $author->published_books_count]) }}
        </p>

    </div>
</a>
