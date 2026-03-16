@props(['publishingHouse'])

<a href="{{ route('publishing-houses.show', $publishingHouse) }}"
   class="group bg-bg-surface rounded-xl border border-border-brand-soft p-5 hover:border-brand hover:shadow-md transition-all duration-300">
    
    <div class="flex items-start gap-6">
        <div class="w-20 h-20 flex flex-shrink-0 items-center justify-center rounded-lg bg-bg-muted">
            @if($publishingHouse->logo)
                <img src="{{ $publishingHouse->logo_url }}" class=" rounded-lg object-cover w-full h-full">
            @else
                <div class="w-20 h-20 flex items-center justify-center rounded-lg text-brand-accent group-hover:bg-brand-accent group-hover:text-white dark:group-hover:text-black transition-colors duration-300">
                    <x-lucide-home class="w-8 h-8" />
                </div>
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-1">
                <h3 class="text-xl font-bold group-hover:text-brand-accent transition">
                    {{ $publishingHouse->name }}
                </h3>
                <x-chip>
                    {{ $publishingHouse->published_books_count }} Books
                </x-chip>
            </div>

            <p class="text-text-muted text-sm leading-relaxed line-clamp-2 mb-4 ms-1">
                {{ $publishingHouse->description ?: 'No description available for this publishing house.' }}
            </p>

            @if($publishingHouse->website_url)
                <div class="flex items-center text-xs font-semibold text-brand-accent uppercase tracking-wider">
                    View Books
                    <x-lucide-arrow-right class="w-3 h-3 ml-1 transform group-hover:translate-x-1 transition-transform" />
                </div>
            @endif
        </div>
    </div>
</a>