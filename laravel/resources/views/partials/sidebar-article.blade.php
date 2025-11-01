<!-- Sidebar for Article Page -->
<nav id="sidebar" class="w-64 bg-base-200 flex-shrink-0 overflow-y-auto p-4 hidden md:block border-r border-base-300">
    <div class="sticky top-20">
        <h3 class="text-lg font-bold mb-5 pb-3 border-b border-base-300">Latest News</h3>
        <div class="space-y-3">
            @foreach($latestArticles as $latest)
            <a href="{{ route('article.show', $latest->slug) }}" class="block group hover:bg-base-300 p-3 rounded-lg transition-all duration-200 border border-transparent hover:border-base-300 hover:shadow-sm">
                <h4 class="text-sm font-semibold line-clamp-2 mb-2 group-hover:text-primary transition-colors leading-snug">
                    {{ $latest->title }}
                </h4>
                <div class="flex items-center gap-2 text-xs text-base-content/60">
                    @if($latest->source_logo)
                    <img src="{{ $latest->source_logo }}" alt="{{ $latest->source }}" class="w-4 h-4 rounded" />
                    @endif
                    <span>{{ $latest->time_ago }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</nav>
