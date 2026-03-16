<x-layout>
    <div class="py-12">
    
        <x-paginated-header 
            :title="__('home.authors')" 
            subtitle="Meet the visionary voices behind our latest collections"
            :collection="$authors" 
        />
        
        @if($authors->isEmpty())
            <div class="bg-bg-surface border border-border-soft rounded-2xl p-12 text-center text-text-muted space-y-4">
                    <x-lucide-users class="w-12 h-12 mx-auto text-text-muted" />
                    <p class="text-text-muted text-lg">{{ __('author.no_authors_found') }}</p>

            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($authors as $author)
                    <x-author-card :author="$author" />
                @endforeach
            </div>
            <div class="mt-10">
                {{ $authors->links() }}
            </div>
        @endif
    </div>
</x-layout>
