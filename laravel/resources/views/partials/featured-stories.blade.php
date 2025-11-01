@if($featuredArticles->count() > 0)
<div class="mb-8" id="featured-stories-section">
    <h2 class="text-lg font-semibold mb-3">Featured Stories</h2>
    <div id="hero-slider" class="hero-slider-container">
        <div class="hero-slider-track">
            @foreach($featuredArticles as $index => $article)
            <a href="{{ route('article.show', $article->slug) }}" class="hero-slide" style="background-image: url('{{ $article->featured_image }}');">
                <div class="hero-slide-content">
                    <h2>{{ $article->title }}</h2>
                </div>
            </a>
            @endforeach
        </div>
        <div class="hero-dots">
            @foreach($featuredArticles as $index => $article)
            <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
    </div>
</div>
@endif

