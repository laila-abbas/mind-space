<x-layout>
    <div class="py-12">
        <div class="flex flex-col md:flex-row items-center md:items-baseline justify-center md:justify-between mb-10 text-center md:text-left space-y-2 md:space-y-0">
            <x-page-heading>{{ __('home.books') }}</x-page-heading>
            <span class="text-sm text-text-muted">{{ $books->total() }} {{ __('author.total') }}</span>
        </div>
        @if($books->isEmpty())
            <div class="bg-bg-surface border border-border-soft rounded-2xl p-12 text-center text-text-muted space-y-4">
                <x-lucide-users class="w-12 h-12 mx-auto text-text-muted" />
                <p class="text-text-muted text-lg">{{ __('author.no_books_yet') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($books as $book)
                    <x-book-card :book="$book" :show-role="false" />
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">
                {{ $books->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-layout>