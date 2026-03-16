<x-layout>
    @if(isset($subcategories))

        {{-- subcategories --}}
        <x-page-heading>{{ $category->name }}</x-page-heading>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach($subcategories as $subcategory)
                <div class="w-1/2 sm:w-1/3 md:w-1/4">
                    <x-category-card :category="$subcategory" :books-count="$subcategory->books_count" />
                </div>
            @endforeach
        </div>

    @else

        {{-- books --}}
        <x-paginated-header :title="$category->name" size="sm" :collection="$books" />

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($books as $book)
                <x-book-card :book="$book" :show-role="false" />
            @endforeach
        </div>

        <div class="mt-10">
            {{ $books->links() }}
        </div>

    @endif
</x-layout>