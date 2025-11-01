@if($breakingNews->count() > 0)
<div class="mb-8" id="breaking-news-section">
    <h2 class="text-lg font-semibold mb-3">Breaking News</h2>
    <div class="highlight-banner card bg-base-200 p-4 rounded-lg">
        <div id="highlight-track" class="highlight-track">
            @foreach($breakingNews as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="highlight-item flex-shrink-0 flex items-center space-x-3 cursor-pointer hover:opacity-80 transition-opacity">
                <span class="badge badge-{{ $article->category_badge_color }} font-bold">{{ strtoupper($article->category) }}</span>
                <span class="text-sm">{{ $article->title }}</span>
            </a>
            @endforeach
            <!-- Duplicated for seamless loop -->
            @foreach($breakingNews as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="highlight-item flex-shrink-0 flex items-center space-x-3 cursor-pointer hover:opacity-80 transition-opacity">
                <span class="badge badge-{{ $article->category_badge_color }} font-bold">{{ strtoupper($article->category) }}</span>
                <span class="text-sm">{{ $article->title }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

