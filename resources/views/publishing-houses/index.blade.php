<x-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <x-paginated-header 
            title="Publishing Houses" 
            subtitle="Explore the world's finest literary curators" 
            :collection="$publishingHouses" 
        />

        <div class="flex flex-col gap-4">
            @foreach($publishingHouses as $publishingHouse)
                <x-publishing-house-card :publishingHouse="$publishingHouse" />
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $publishingHouses->links() }}
        </div>
    </div>
</x-layout>