@props(['category', 'booksCount' => null])

<a href="{{ route('categories.show', $category) }}" 
                   class="group relative flex flex-col items-center p-6 bg-bg-surface border border-border-default rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    
    <div class="mb-4 p-4 rounded-xl bg-brand-accent/10 text-brand-accent group-hover:bg-brand-accent group-hover:text-white dark:group-hover:text-black transition-colors duration-300">
        @php
            $icon = $category->icon ?? 'book-marked';
        @endphp
        <x-dynamic-component 
            :component="'lucide-' . $icon" 
            class="w-8 h-8" 
            stroke-width="1.5"
        />
    </div>

    <h3 class="text-xl font-bold text-text-strong group-hover:text-brand-accent transition-colors">
        {{ $category->name }}
    </h3>
    @php $subCount = $category->children_count ?? 0; @endphp
    <span class="mt-2 text-xs font-medium text-text-muted uppercase tracking-wider">
        @if($subCount > 0)
            {{ $subCount }} Subcategories
        @elseif($booksCount)
            {{ $booksCount }} Books
        @else
            Browse Collection
        @endif
    </span>

    <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
        <x-lucide-chevron-right class="w-4 h-4 text-brand-accent" />
    </div>
</a>