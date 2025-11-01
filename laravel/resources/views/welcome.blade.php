@extends('layouts.app')

@section('title', 'SocialShare - Your News, Your Way')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <!-- Breaking News Section (Partial) -->
    @include('partials.breaking-news', ['breakingNews' => $breakingNews])

    <!-- Featured Stories Section (Partial) -->
    @include('partials.featured-stories', ['featuredArticles' => $featuredArticles])

    <!-- Article Grid Section (Partial - Can be reloaded via AJAX) -->
    <div id="article-grid-container">
        @include('partials.article-grid', ['articles' => $articles])
    </div>

    <!-- Heard The News Section (Partial) -->
    @include('partials.heard-the-news', ['heardTheNews' => $heardTheNews])
@endsection

@push('scripts')
<script>
    // Breaking News Marquee - Initialize auto-scroll
    document.addEventListener('DOMContentLoaded', () => {
        const highlightTrack = document.getElementById('highlight-track');
        if (highlightTrack) {
            // Wait for layout to calculate proper widths
            setTimeout(() => {
                // Get all items
                const items = highlightTrack.querySelectorAll('.highlight-item');
                const itemCount = items.length;
                const firstHalfCount = itemCount / 2;
                
                // Create a temporary container to measure first half width accurately
                const firstHalf = Array.from(items).slice(0, firstHalfCount);
                let firstHalfWidth = 0;
                
                // Measure each item including gaps (gap is applied by CSS flexbox)
                firstHalf.forEach((item) => {
                    const rect = item.getBoundingClientRect();
                    firstHalfWidth += rect.width;
                });
                
                // Get computed gap value from CSS
                const computedStyle = window.getComputedStyle(highlightTrack);
                const gap = parseFloat(computedStyle.gap) || 32; // Default to 32px if gap not found
                
                // Calculate: first half width + gaps between items + second half width + gaps
                // For firstHalfCount items, there are (firstHalfCount - 1) gaps
                const gapsInFirstHalf = (firstHalfCount - 1) * gap;
                const firstHalfTotal = firstHalfWidth + gapsInFirstHalf;
                
                // Total width = first half + one gap + second half (which is duplicate of first half)
                // This ensures seamless looping
                highlightTrack.style.width = `${(firstHalfTotal * 2) + gap}px`;
            }, 100);
            
            // Pause on hover (CSS handles this too, but JS ensures it works)
            const banner = highlightTrack.closest('.highlight-banner');
            if (banner) {
                banner.addEventListener('mouseenter', () => {
                    highlightTrack.style.animationPlayState = 'paused';
                });
                banner.addEventListener('mouseleave', () => {
                    highlightTrack.style.animationPlayState = 'running';
                });
            }
        }
    });

    // Hero Slider
    document.addEventListener('DOMContentLoaded', () => {
        const slider = document.getElementById('hero-slider');
        if (slider) {
            const track = slider.querySelector('.hero-slider-track');
            const slides = Array.from(track.querySelectorAll('.hero-slide'));
            const dots = Array.from(slider.querySelectorAll('.hero-dot'));
            const slideCount = slides.length;
            let currentSlide = 0;
            let autoScrollInterval;

            if (slideCount === 0) return;

            track.style.width = `${slideCount * 100}%`;

            function goToSlide(slideIndex) {
                if (slideIndex < 0 || slideIndex >= slideCount) return;
                
                track.style.transform = `translateX(-${slideIndex * (100 / slideCount)}%)`;
                
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === slideIndex);
                });
                
                currentSlide = slideIndex;
            }

            function nextSlide() {
                const nextSlideIndex = (currentSlide + 1) % slideCount;
                goToSlide(nextSlideIndex);
            }

            function startAutoScroll() {
                stopAutoScroll();
                autoScrollInterval = setInterval(nextSlide, 5000);
            }

            function stopAutoScroll() {
                clearInterval(autoScrollInterval);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const slideIndex = parseInt(dot.dataset.slide, 10);
                    goToSlide(slideIndex);
                });
            });

            slider.addEventListener('mouseenter', stopAutoScroll);
            slider.addEventListener('mouseleave', startAutoScroll);

            goToSlide(0);
            startAutoScroll();
        }
    });

    // AJAX Pagination
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
