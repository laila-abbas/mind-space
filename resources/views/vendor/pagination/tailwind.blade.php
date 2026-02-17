@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center items-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-bg-muted text-text-muted rounded-lg cursor-not-allowed">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-bg-surface text-text-main rounded-lg hover:bg-brand-hover transition">
                &laquo;
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element)) {{-- for the ... case --}}
                <span class="px-3 py-2 bg-bg-muted text-text-muted rounded-lg">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-brand-hover text-text-strong rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-bg-surface text-text-main rounded-lg hover:bg-brand-hover transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-bg-surface text-text-main rounded-lg hover:bg-brand-hover transition">
                &raquo;
            </a>
        @else
            <span class="px-4 py-2 bg-bg-muted text-text-muted rounded-lg cursor-not-allowed">
                &raquo;
            </span>
        @endif
    </nav>
@endif
