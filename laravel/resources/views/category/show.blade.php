@extends('layouts.app')

@section('title', ucfirst($category) . ' News - SocialShare')

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

    <!-- Category Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <span class="badge badge-{{ \App\Models\Article::getCategoryBadgeColor($category) }} badge-lg font-semibold px-4 py-2">
                {{ strtoupper($category) }}
            </span>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight tracking-tight">
            {{ \App\Models\Article::getCategoryDisplayName($category) }} News
        </h1>
        <p class="text-base-content/70 text-lg">
            Latest articles in the {{ \App\Models\Article::getCategoryDisplayName($category) }} category
        </p>
    </div>

    <!-- Article Grid Section -->
    <div id="article-grid-container">
        @if($articles->count() > 0)
        <div class="mb-8" id="article-grid-section">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                @foreach($articles as $article)
                <a href="{{ route('article.show', $article->slug) }}" class="card bg-base-200 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer group overflow-hidden border border-base-300 rounded-xl">
                    <figure class="relative overflow-hidden bg-base-300 aspect-video">
                        <img 
                            src="{{ $article->featured_image_url }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                            loading="lazy"
                        />
                        @if($article->category)
                        <div class="absolute top-3 left-3">
                            <span class="badge badge-{{ $article->category_badge_color }} badge-sm font-semibold">{{ strtoupper($article->category) }}</span>
                        </div>
                        @endif
                    </figure>
                    <div class="card-body p-4">
                        <div class="flex items-start gap-3">
                            <div class="avatar flex-shrink-0">
                                @if($article->source_logo)
                                <div class="w-8 h-8 rounded-lg overflow-hidden">
                                    <img src="{{ $article->source_logo }}" alt="{{ $article->source }}" class="w-full h-full object-cover" />
                                </div>
                                @else
                                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                                    <span class="text-primary-content text-xs font-bold">{{ strtoupper(substr($article->source ?? 'ST', 0, 2)) }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold line-clamp-2 group-hover:text-primary transition-colors mb-2 leading-tight">
                                    {{ $article->title }}
                                </h3>
                                <div class="flex items-center gap-2 text-xs text-base-content/60">
                                    <span class="font-medium">{{ $article->source }}</span>
                                    <span>•</span>
                                    <span>{{ $article->time_ago }}</span>
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
    </div>

</div>
@endsection

@push('scripts')
<script>
    // AJAX Pagination for Category Page
    document.addEventListener('DOMContentLoaded', function() {
        const articleGridContainer = document.getElementById('article-grid-container');
        
        if (!articleGridContainer) return;

        // Function to handle pagination clicks
        async function handlePaginationClick(e) {
            // Find the clicked link
            const link = e.target.closest('a');
            if (!link) return;
            
            // Check if it's a pagination link (inside pagination nav or has page in URL)
            const paginationNav = link.closest('[role="navigation"][aria-label="Pagination Navigation"]');
            const isPaginationLink = paginationNav && (
                link.href.includes('?page=') || 
                link.href.includes('/page/') ||
                link.getAttribute('aria-label')?.includes('page') ||
                link.getAttribute('aria-label')?.includes('Previous') ||
                link.getAttribute('aria-label')?.includes('Next')
            );
            
            if (!isPaginationLink) return;
            
            e.preventDefault();
            
            const url = link.href;
            
            // Show loading state
            articleGridContainer.style.opacity = '0.6';
            articleGridContainer.style.transition = 'opacity 0.2s';
            articleGridContainer.style.pointerEvents = 'none';
            
            try {
                // Make AJAX request
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const html = await response.text();
                
                // Update the article grid container
                articleGridContainer.innerHTML = html;
                
                // Scroll to top of article grid smoothly
                articleGridContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Update browser history without reload
                window.history.pushState({ path: url }, '', url);
                
            } catch (error) {
                console.error('Error loading articles:', error);
                alert('Failed to load articles. Please try again.');
            } finally {
                // Remove loading state
                articleGridContainer.style.opacity = '1';
                articleGridContainer.style.pointerEvents = 'auto';
            }
        }

        // Use event delegation for pagination links
        document.addEventListener('click', handlePaginationClick);

        // Handle browser back/forward buttons
        window.addEventListener('popstate', async function(e) {
            const url = window.location.href;
            
            try {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                });
                
                if (response.ok) {
                    const html = await response.text();
                    articleGridContainer.innerHTML = html;
                }
            } catch (error) {
                console.error('Error loading articles:', error);
                // Fallback to full page reload
                window.location.reload();
            }
        });
    });
</script>
@endpush

