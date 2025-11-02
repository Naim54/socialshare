@if($heardTheNews->count() > 0)
<div class="mb-8" id="heard-the-news-section">
    <h2 class="text-xl font-bold mb-4">HEARD THE NEWS?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($heardTheNews as $article)
        <a href="{{ route('article.show', $article->slug) }}" class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow cursor-pointer group">
            <figure class="relative overflow-hidden">
                <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
            </figure>
            <div class="card-body p-4">
                <div class="text-xs text-base-content/60 mb-1">{{ ucfirst($article->category) }}</div>
                <div class="text-xs text-base-content/60 mb-2">{{ $article->formatted_date }}</div>
                <h3 class="card-title text-base line-clamp-2 group-hover:text-primary transition-colors">
                    {{ $article->title }}
                </h3>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

