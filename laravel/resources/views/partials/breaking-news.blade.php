@if($breakingNews->count() > 0)
<div class="mb-6 md:mb-8" id="breaking-news-section">
    <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Breaking News</h2>
    <div class="highlight-banner card bg-base-200 p-3 md:p-4 rounded-lg">
        <div id="highlight-track" class="highlight-track">
            @foreach($breakingNews as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="highlight-item flex-shrink-0 flex items-center space-x-2 md:space-x-3 cursor-pointer hover:opacity-80 transition-opacity">
                <span class="badge badge-{{ $article->category_badge_color }} font-bold text-xs md:text-sm">{{ strtoupper($article->category) }}</span>
                <span class="text-xs md:text-sm line-clamp-1">{{ $article->title }}</span>
            </a>
            @endforeach
            <!-- Duplicated for seamless loop -->
            @foreach($breakingNews as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="highlight-item flex-shrink-0 flex items-center space-x-2 md:space-x-3 cursor-pointer hover:opacity-80 transition-opacity">
                <span class="badge badge-{{ $article->category_badge_color }} font-bold text-xs md:text-sm">{{ strtoupper($article->category) }}</span>
                <span class="text-xs md:text-sm line-clamp-1">{{ $article->title }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

