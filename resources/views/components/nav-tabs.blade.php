@props(['mobile' => false])

@php
    $tabs = [
        ['label' => __('home.home'), 'url' => '/'], // edit route
        ['label' => __('home.books'), 'url' => route('books.index')], // edit route
        ['label' => __('home.authors'), 'url' => route('authors.index')],
        ['label' => __('home.categories'), 'url' => '/categories'], // edit route
        ['label' => __('home.publishing_houses'), 'url' => '/publishing-houses'], // edit route
    ];
@endphp

@foreach($tabs as $tab)
    @php 
        $isActive = request()->fullUrlIs($tab['url']);
    @endphp

    @if($mobile)
        <a 
            href="{{ $tab['url'] }}"
            class="px-4 py-2 rounded-lg transition 
                    {{ $isActive 
                        ? 'bg-brand-hover/10 text-brand-accent font-bold' 
                        : 'text-text-main hover:bg-brand-hover hover:text-bg-surface' 
                    }}"
        >
            {{ $tab['label'] }}
        </a>
    @else
        <a 
            href="{{ $tab['url'] }}"
            class="relative px-1 transition duration-300 group font-bold {{ $isActive ? 'text-brand-accent' : 'text-text-main hover:text-brand-accent' }}"
        >
            {{ $tab['label'] }}
            <span class="absolute start-0 -bottom-1 h-0.5 bg-brand-accent transition-all duration-300 {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
        </a>
    @endif
@endforeach
