@props(['mobile' => false])

@php
    $tabs = [
        ['label' => __('home.home'), 'url' => '/'], // edit route
        ['label' => __('home.books'), 'url' => '/books'], // edit route
        ['label' => __('home.authors'), 'url' => route('authors.index')],
        ['label' => __('home.categories'), 'url' => '/categories'], // edit route
        ['label' => __('home.publishing_houses'), 'url' => '/publishing-houses'], // edit route
    ];
@endphp

@foreach($tabs as $tab)
    @if($mobile)
        <a 
            href="{{ $tab['url'] }}"
            class="px-4 py-2 rounded-lg text-text-main hover:bg-brand-hover hover:text-bg-surface transition"
        >
            {{ $tab['label'] }}
        </a>
    @else
        <a 
            href="{{ $tab['url'] }}"
            class="relative px-1 text-text-main hover:text-brand-accent transition duration-300 group font-bold"
        >
            {{ $tab['label'] }}
            <span class="absolute start-0 -bottom-1 w-0 h-0.5 bg-brand-accent transition-all duration-300 group-hover:w-full"></span>
        </a>
    @endif
@endforeach
