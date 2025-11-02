@if($articles->count() > 0)
<div class="mb-8" id="article-grid-section">
    <h2 class="text-lg font-semibold mb-4">Latest Articles</h2>
    <div class="article-grid">
        @foreach($articles as $article)
        <a href="{{ route('article.show', $article->slug) }}" class="card bg-base-200 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer group overflow-hidden border border-base-300">
            <figure class="relative overflow-hidden bg-base-300">
                <img 
                    src="{{ $article->featured_image_url }}" 
                    alt="{{ $article->title }}" 
                    class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500" 
                    loading="lazy"
                />
                @if($article->category)
                <div class="absolute top-3 left-3">
                    <span class="badge badge-{{ $article->category_badge_color }} badge-sm font-semibold">{{ strtoupper($article->category) }}</span>
                </div>
                @endif
            </figure>
            <div class="card-body p-5">
                <div class="flex items-start gap-3">
                    <div class="avatar flex-shrink-0">
                        @if($article->source_logo)
                        <div class="w-10 h-10 rounded-lg overflow-hidden">
                            <img src="{{ $article->source_logo }}" alt="{{ $article->source }}" class="w-full h-full object-cover" />
                        </div>
                        @else
                        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
                            <span class="text-primary-content text-xs font-bold">{{ strtoupper(substr($article->source ?? 'ST', 0, 2)) }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold line-clamp-2 group-hover:text-primary transition-colors mb-2 leading-tight">
                            {{ $article->title }}
                        </h3>
                        <div class="flex items-center gap-2 text-xs text-base-content/60">
                            <span class="font-medium">{{ $article->source }}</span>
                            <span>•</span>
                            <span>{{ $article->time_ago }}</span>
                            @if($article->reading_time)
                            <span>•</span>
                            <span>{{ $article->reading_time }} min read</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="flex justify-center mt-8 mb-4" id="pagination-container">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endif

