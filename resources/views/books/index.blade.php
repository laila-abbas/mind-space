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
                <p class="text-text-muted text-lg">{{ __('author.no_books_yet') }}</p>
            </div>
        @else
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