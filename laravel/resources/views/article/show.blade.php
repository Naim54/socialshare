@extends('layouts.app')

@section('title', $article->title . ' - SocialShare')

@section('body-class', 'min-h-screen')

@section('content-wrapper-class', '')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('main-class', 'p-4 md:p-6 lg:p-8 bg-base-100')

@section('content')
<div class="w-full px-4 md:px-6 lg:px-8">
    
    <!-- Back Button -->
    <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 mb-8 text-base-content/70 hover:text-base-content transition-colors group">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        <span class="font-medium">Back to Home</span>
    </a>

    <!-- Article Header -->
    <article class="article-content">
        @if($article->category)
        <div class="mb-5">
            <span class="badge badge-{{ $article->category_badge_color }} badge-lg font-semibold px-4 py-2">
                {{ strtoupper($article->category) }}
            </span>
        </div>
        @endif

        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight tracking-tight">
            {{ $article->title }}
        </h1>

        <!-- Article Meta -->
        <div class="flex flex-wrap items-center gap-4 mb-8 pb-6 border-b border-base-300">
            <div class="flex items-center gap-2.5">
                @if($article->source_logo)
                <img src="{{ $article->source_logo }}" alt="{{ $article->source }}" class="w-7 h-7 rounded-md shadow-sm" />
                @else
                <div class="w-7 h-7 rounded-md bg-primary flex items-center justify-center shadow-sm">
                    <span class="text-primary-content text-xs font-bold">{{ strtoupper(substr($article->source ?? 'ST', 0, 2)) }}</span>
                </div>
                @endif
                <span class="font-semibold text-base-content">{{ $article->source }}</span>
            </div>
            <span class="text-base-content/40">•</span>
            <div class="flex items-center gap-1.5 text-sm text-base-content/70">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ $article->formatted_date }}</span>
            </div>
            @if($article->reading_time)
            <span class="text-base-content/40">•</span>
            <div class="flex items-center gap-1.5 text-sm text-base-content/70">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span>{{ $article->reading_time }} min read</span>
            </div>
            @endif
            <span class="text-base-content/40">•</span>
            <div class="flex items-center gap-1.5 text-sm text-base-content/70">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <span>{{ number_format($article->views) }} views</span>
            </div>
        </div>

        <!-- Featured Image -->
        @if($article->featured_image)
        <div class="mb-10 rounded-xl overflow-hidden shadow-lg border border-base-300">
            <img 
                src="{{ $article->featured_image }}" 
                alt="{{ $article->title }}" 
                class="w-full h-auto object-cover"
                loading="lazy"
            />
        </div>
        @endif

        <!-- Article Excerpt -->
        @if($article->excerpt)
        <div class="mb-10 p-6 bg-base-200/50 rounded-xl border-l-4 border-primary shadow-sm">
            <p class="text-xl text-base-content/90 leading-relaxed font-medium">{{ $article->excerpt }}</p>
        </div>
        @endif

        <!-- Article Content -->
        <div class="article-body mb-12">
            <div class="text-lg text-base-content/90 leading-relaxed whitespace-pre-wrap space-y-6">
                @foreach(explode("\n\n", $article->content) as $paragraph)
                    @if(trim($paragraph))
                    <p class="mb-6">{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Social Share Buttons -->
        <div class="mb-12 pb-8 border-b border-base-300">
            <x-social-share-buttons 
                :articleId="$article->id"
                :pageUrl="url()->current()" 
            />
        </div>

        <!-- Article Footer -->
        <div class="border-t border-base-300 pt-8 mb-12">
            <div class="flex flex-wrap items-center justify-between gap-4 p-6 bg-base-200/30 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        @if($article->source_logo)
                        <img src="{{ $article->source_logo }}" alt="{{ $article->source }}" class="w-8 h-8 rounded-md" />
                        @else
                        <span class="text-primary text-sm font-bold">{{ strtoupper(substr($article->source ?? 'ST', 0, 2)) }}</span>
                        @endif
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60 mb-0.5">Published by</div>
                        <div class="font-semibold text-base-content">{{ $article->source }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-base-content/60 mb-0.5">Published on</div>
                    <div class="font-medium text-base-content">{{ $article->formatted_date }}</div>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="mt-16 pt-12 border-t border-base-300">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-1 h-8 bg-primary rounded-full"></div>
            <h2 class="text-2xl font-bold">Related Articles</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedArticles as $related)
            <a href="{{ route('article.show', $related->slug) }}" class="card bg-base-200 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer group overflow-hidden border border-base-300 rounded-xl">
                <figure class="relative overflow-hidden bg-base-300 aspect-video">
                    <img 
                        src="{{ $related->featured_image }}" 
                        alt="{{ $related->title }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                        loading="lazy"
                    />
                    @if($related->category)
                    <div class="absolute top-3 left-3">
                        <span class="badge badge-{{ $related->category_badge_color }} badge-sm font-semibold shadow-md">{{ strtoupper($related->category) }}</span>
                    </div>
                    @endif
                </figure>
                <div class="card-body p-6">
                    <h3 class="text-lg font-semibold line-clamp-2 group-hover:text-primary transition-colors mb-3 leading-tight">
                        {{ $related->title }}
                    </h3>
                    <div class="flex items-center gap-2 text-sm text-base-content/60">
                        <span class="font-medium">{{ $related->source }}</span>
                        <span>•</span>
                        <span>{{ $related->time_ago }}</span>
                        @if($related->reading_time)
                        <span>•</span>
                        <span>{{ $related->reading_time }} min</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Latest News Section -->
    @if($latestArticles->count() > 0)
    <div class="mt-16 pt-12 border-t border-base-300">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-1 h-8 bg-primary rounded-full"></div>
            <h2 class="text-2xl font-bold">Latest News</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($latestArticles as $latest)
            <a href="{{ route('article.show', $latest->slug) }}" class="card bg-base-200 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer group overflow-hidden border border-base-300 rounded-xl">
                <figure class="relative overflow-hidden bg-base-300 aspect-video">
                    <img 
                        src="{{ $latest->featured_image }}" 
                        alt="{{ $latest->title }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                        loading="lazy"
                    />
                    @if($latest->category)
                    <div class="absolute top-3 left-3">
                        <span class="badge badge-{{ $latest->category_badge_color }} badge-sm font-semibold">{{ strtoupper($latest->category) }}</span>
                    </div>
                    @endif
                </figure>
                <div class="card-body p-4">
                    <h3 class="text-sm font-semibold line-clamp-2 group-hover:text-primary transition-colors mb-2 leading-tight">
                        {{ $latest->title }}
                    </h3>
                    <div class="flex items-center gap-2 text-xs text-base-content/60">
                        <span class="font-medium">{{ $latest->source }}</span>
                        <span>•</span>
                        <span>{{ $latest->time_ago }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    // Sidebar Toggle for Article Page (mobile)
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush
