<header>
    <h2 class="text-2xl font-bold text-text-strong">{{ $slot }}</h2>
    @isset($description)
        <p class="mt-1 text-sm text-text-muted">{{ $description }}</p>
    @endisset
</header>
