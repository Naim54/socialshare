@if($featuredArticles->count() > 0)
<div class="mb-8" id="featured-stories-section">
    <h2 class="text-lg font-semibold mb-4">Featured Stories</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($featuredArticles->take(4) as $article)
        <a href="{{ route('article.show', $article->slug) }}" class="flex flex-col md:flex-row gap-0 bg-base-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all group">
            <div class="flex-shrink-0 md:w-2/5 w-full">
                <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-[200px] md:h-full object-cover group-hover:scale-105 transition-transform duration-300" />
            </div>
            <div class="flex-1 md:w-3/5 flex flex-col justify-center p-4 md:p-5 bg-base-200">
                <div class="text-xs text-base-content/60 mb-2 uppercase tracking-wide">{{ ucfirst($article->category ?? 'News') }}</div>
                <h2 class="text-lg md:text-xl font-bold mb-2 text-base-content group-hover:text-primary transition-colors line-clamp-2">
                    {{ $article->title }}
                </h2>
                @if($article->excerpt)
                    <p class="text-sm text-base-content/80 mb-2 line-clamp-2">
                        {{ $article->excerpt }}
                    </p>
                @else
                    <p class="text-sm text-base-content/80 mb-2 line-clamp-2">
                        {{ Str::limit(strip_tags($article->content ?? ''), 100) }}
                    </p>
                @endif
                <div class="text-xs text-base-content/60">{{ $article->formatted_date ?? $article->published_at?->format('M d, Y') }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

