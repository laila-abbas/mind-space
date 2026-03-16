<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-12 flex flex-col sm:flex-row gap-8 items-start sm:items-center bg-bg-surface p-8 rounded-2xl border border-border-brand-soft shadow-sm">
            <div class="w-32 h-32 flex-shrink-0 flex items-center justify-center rounded-2xl bg-bg-muted border border-border-soft shadow-inner">
                @if($publishingHouse->logo)
                    <img src="{{ $publishingHouse->logo_url }}" class="object-cover w-full h-full rounded-2xl">
                @else
                    <div class="text-brand-accent/70">
                         <x-lucide-home class="w-12 h-12" />
                    </div>
                @endif
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <h1 class="text-4xl font-bold text-text-strong tracking-tight">
                        {{ $publishingHouse->name }}
                    </h1>
                </div>

                @if($publishingHouse->description)
                    <p class="text-md text-text-muted max-w-3xl leading-relaxed mb-6">
                        {{ $publishingHouse->description }}
                    </p>
                @endif

                <div class="flex flex-wrap gap-6 text-sm font-semibold">
                    @if($publishingHouse->website_url)
                        <a 
                            href="{{ $publishingHouse->website_url }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="flex items-center text-brand-accent hover:underline gap-1.5">
                            <x-lucide-globe class="w-4 h-4" />
                            Official Website
                        </a>
                    @endif

                    @if($publishingHouse->email)
                        <div class="flex items-center text-text-subtle gap-1.5">
                            <x-lucide-mail class="w-4 h-4" />
                            {{ $publishingHouse->email }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <x-forms.divider />

        <x-paginated-header :title="'Catalogue'" size="sm" :collection="$books" />

        {{-- books --}}
        @if($books->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($books as $book)
                    <x-book-card :book="$book" :show-role="false" />
                @endforeach
            </div>

            <div class="mt-12">
                {{ $books->links() }}
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 bg-brand-soft/10 rounded-2xl border-2 border-dashed border-border-brand-soft">
                <div class="p-4 rounded-full bg-bg-surface mb-4 shadow-sm">
                    <x-lucide-book-x class="w-10 h-10 text-brand-accent/30" />
                </div>
                <p class="text-text-muted font-medium text-lg">No published books found for this house.</p>
            </div>
        @endif

    </div>
</x-layout>