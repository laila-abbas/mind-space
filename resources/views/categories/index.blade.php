<x-layout>
    <div class="py-12 max-w-7xl mx-auto px-12">

        <x-page-heading>Explore Categories</x-page-heading>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($categories as $category)
                <x-category-card :category='$category' />
            @endforeach
        </div>
    </div>
</x-layout>