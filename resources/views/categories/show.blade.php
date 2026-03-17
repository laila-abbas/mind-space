<x-layout>

    <x-paginated-header :title="$category->name" size="sm" :collection="$books" />

    @if($subcategories->count())
        <div class="flex flex-wrap gap-2 justify-center mb-6">

            <a href="{{ route('categories.show', $category) }}"
               class="px-4 py-2 rounded-full border border-border-default text-sm hover:bg-brand-hover transition-all duration-300 {{ request('subcategory') ? '' : 'bg-brand' }}">
                All
            </a>

            @foreach($subcategories as $subcategory)
                <a href="{{ route('categories.show', [$category, 'subcategory' => $subcategory->slug]) }}"
                   class="px-4 py-2 rounded-full border border-border-default text-sm hover:bg-brand-hover transition-all duration-300 {{ request('subcategory') === $subcategory->slug ? 'bg-brand' : '' }}">
                    <span class="flex items-center gap-1">
                        <x-dynamic-component :component="'lucide-' . $subcategory->icon" class="w-4 h-4"/>
                        {{ $subcategory->name }}
                    </span>
                </a>
            @endforeach

        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($books as $book)
            <x-book-card :book="$book" :show-role="false" />
        @endforeach
    </div>

    <div class="mt-10">
        {{ $books->links() }}
    </div>

</x-layout>