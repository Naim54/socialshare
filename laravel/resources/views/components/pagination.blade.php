@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="p-2 rounded text-sm text-base-content/40 hover:bg-base-300 cursor-not-allowed transition-colors" disabled aria-label="Previous page">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="p-2 rounded text-sm text-base-content hover:bg-base-300 transition-colors" aria-label="Previous page">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center gap-0.5 mx-1">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-2 py-1 text-base-content/50 text-sm">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="px-3 py-1.5 rounded text-sm font-medium bg-primary text-primary-content min-w-[32px] cursor-default" aria-current="page" aria-label="Page {{ $page }}">
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 rounded text-sm font-medium text-base-content hover:bg-base-300 transition-colors min-w-[32px] text-center" aria-label="Page {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="p-2 rounded text-sm text-base-content hover:bg-base-300 transition-colors" aria-label="Next page">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <button class="p-2 rounded text-sm text-base-content/40 hover:bg-base-300 cursor-not-allowed transition-colors" disabled aria-label="Next page">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
    </nav>
@endif

