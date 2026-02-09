@props(['description' => null,'h2color' => 'text-text-strong', 'pcolor' => 'text-text-muted'])
<header>
    <h2 class="text-2xl font-bold {{ $h2color }}">{{ $slot }}</h2>
    @isset($description)
        <p class="mt-1 text-sm {{ $pcolor }}">{{ $description }}</p>
    @endisset
</header>
