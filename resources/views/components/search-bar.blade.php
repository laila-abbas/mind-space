@props(['mobile' => false])

<form action="{{ route('books.index') }}" method="GET" 
    @if(!$mobile) 
        x-data="{ expanded: false }" 
        @click.away="expanded = false"
    @endif
    class="{{ $mobile ? 'px-4 py-2' : 'flex items-center' }}">
    
    <div class="relative w-full">
        <input 
            id = "search-query"
            type="text" 
            name="q" 
            value="{{ request('q') }}" 
            placeholder='Search...'
            @if(!$mobile)
                @focus="expanded = true"
                :class="expanded ? 'w-64' : 'w-40'"
            @endif
            class="transition-all duration-300 ease-in-out bg-bg-muted rounded-full py-1.5 ps-10 pe-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-accent {{ $mobile ? 'w-full' : '' }}"
        >
        
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-lucide-search class="w-4 h-4 text-text-muted" />
        </div>
    </div>
</form>