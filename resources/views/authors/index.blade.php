<x-layout>
    <div class="py-12">
        <div class="flex flex-col md:flex-row items-center md:items-baseline justify-center md:justify-between mb-10 text-center md:text-left space-y-2 md:space-y-0">
            <x-page-heading>{{ __('home.authors') }}</x-page-heading>
            <span class="text-sm text-text-muted">{{ $authors->total() }} {{ __('author.total') }}</span>
        </div>

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
            <div class="mt-10 flex justify-center">
                {{ $authors->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-layout>
