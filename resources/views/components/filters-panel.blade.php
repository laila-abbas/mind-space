@props(['action' => route('books.index')])

<div x-data="{ open: false }" class="flex justify-end mb-4">

    <div class="relative">
        <button @click="open = true"
            class="flex items-center gap-2 px-4 py-2 rounded-xl bg-bg-surface border border-border-soft text-sm hover:bg-bg-muted transition cursor-pointer">
            <x-lucide-sliders-horizontal class="w-4 h-4" />
            Filters
        </button>

        {{-- overlay for mobile --}}
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-bg-overlay sm-md:hidden"></div>

        {{-- panel --}}
        <div
            x-show="open"
            x-transition
            x-cloak
            @click.away="open = false"
            class="
                fixed sm-md:absolute z-50
                bottom-0 sm-md:bottom-auto
                inset-x-0 sm-md:inset-auto sm-md:end-0
                w-full sm-md:w-80
                max-h-[80vh]
                bg-bg-muted
                rounded-t-2xl sm-md:rounded-2xl
                shadow-2xl
                border border-border-soft
                overflow-y-auto {{-- vertical scrollbar appears when the content doesn't fit --}}
            "
        >
            <form 
                @submit="
                    const search = document.getElementById('search-query')?.value;
                    if (search !== null) {
                        $el.querySelector('input[name=q]').value = search;
                    }"
                action="{{ $action }}" method="GET" class="p-4 space-y-2">

                {{-- preserve search --}}
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">

                {{-- header --}}
                <div class="flex justify-between items-center">
                    <h3 class="text-sm font-semibold">Filters</h3>
                    <button type="button" @click="open = false">
                        <x-lucide-x class="w-4 h-4 text-text-muted cursor-pointer" />
                    </button>
                </div>

                {{-- language --}}
                <x-filter
                    label="Language"
                    name="language"
                    type="select"
                    :options="[
                        'English' => 'English',
                        'Arabic' => 'Arabic',
                        'French' => 'French',
                    ]"
                />

                <x-filter
                    label="Format"
                    name="format"
                    type="select"
                    :options="[
                        'hardcover' => 'Hardcover',
                        'paperback' => 'Paperback',
                        'e-book' => 'E-Book',
                        'audiobook' => 'Audio Book',
                    ]"
                />

                {{-- price --}}
                <x-filter
                    label="Max price"
                    name="price_max"
                    type="number"
                    step="0.01"
                    min="0"
                    placeholder="0.00"
                />

                {{-- published_at --}}
                <x-filter
                    label="Published after"
                    name="published_from"
                    type="number"
                    min="1000"
                    placeholder="e.g. 2020"
                />

                {{-- actions --}}
                <div class="flex items-center justify-between pt-1">
                    
                    <a href="{{ request()->fullUrlWithoutQuery(['language','format','price_max','published_from']) }}"
                    class="text-sm text-text-muted hover:underline">
                        Clear
                    </a>

                    <button type="submit"
                        class="px-5 py-1.5 rounded-xl bg-brand hover:bg-brand-hover cursor-pointer transition">
                        Apply
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>