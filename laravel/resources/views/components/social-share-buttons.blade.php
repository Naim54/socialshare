@props(['pageUrl' => '', 'pageTitle' => '', 'pageMetadata' => [], 'articleId' => null])

<div class="social-share-buttons flex flex-wrap items-center gap-2 sm:gap-3 {{ $attributes->get('class') }}">
    <span class="text-xs sm:text-sm font-semibold text-base-content/70 mr-1 sm:mr-2">Share:</span>
    
    <!-- Facebook -->
    <a href="#" 
       class="social-share-btn flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-colors duration-200 shadow-md hover:shadow-lg"
       data-platform="facebook"
       data-article-id="{{ $articleId }}"
       data-page-url="{{ $pageUrl }}"
       title="Share on Facebook"
       aria-label="Share on Facebook">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
    </a>

    <!-- X (Twitter) -->
    <a href="#" 
       class="social-share-btn flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-black hover:bg-gray-800 text-white transition-colors duration-200 shadow-md hover:shadow-lg"
       data-platform="twitter"
       data-article-id="{{ $articleId }}"
       data-page-url="{{ $pageUrl }}"
       title="Share on X (Twitter)"
       aria-label="Share on X (Twitter)">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
    </a>

    <!-- WhatsApp -->
    <a href="#" 
       class="social-share-btn flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-green-600 hover:bg-green-700 text-white transition-colors duration-200 shadow-md hover:shadow-lg"
       data-platform="whatsapp"
       data-article-id="{{ $articleId }}"
       data-page-url="{{ $pageUrl }}"
       title="Share on WhatsApp"
       aria-label="Share on WhatsApp">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.77.966-.94 1.164-.17.199-.343.223-.636.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.984-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <!-- Telegram -->
    <a href="#" 
       class="social-share-btn flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-blue-500 hover:bg-blue-600 text-white transition-colors duration-200 shadow-md hover:shadow-lg"
       data-platform="telegram"
       data-article-id="{{ $articleId }}"
       data-page-url="{{ $pageUrl }}"
       title="Share on Telegram"
       aria-label="Share on Telegram">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.35-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
        </svg>
    </a>

    <!-- Email -->
    <a href="#" 
       class="social-share-btn flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-gray-700 hover:bg-gray-800 text-white transition-colors duration-200 shadow-md hover:shadow-lg"
       data-platform="email"
       data-article-id="{{ $articleId }}"
       data-page-url="{{ $pageUrl }}"
       title="Share via Email"
       aria-label="Share via Email">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </a>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const shareButtons = document.querySelectorAll('.social-share-btn');
    const apiEndpoint = '{{ url("/api/social-share/track") }}';
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const platform = this.dataset.platform;
            const articleId = this.dataset.articleId || null;
            const pageUrl = this.dataset.pageUrl || window.location.href;
            const pageTitle = document.title;

            // Get page metadata from Open Graph tags if available
            let pageMetadata = {};
            const ogDesc = document.querySelector('meta[property="og:description"]');
            const ogImage = document.querySelector('meta[property="og:image"]');
            if (ogDesc) pageMetadata.description = ogDesc.getAttribute('content');
            if (ogImage) pageMetadata.image = ogImage.getAttribute('content');

            // Prepare tracking data
            const trackingData = {
                platform: platform,
                article_id: articleId || null,
                page_url: pageUrl, // Always save the page URL for reference
            };

            // Track the click
            fetch(apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(trackingData)
            }).catch(err => {
                console.error('Failed to track share click:', err);
            });

            // Open share dialog - use pageUrl (article URL will be included if articleId is present)
            let shareUrl = '';
            const encodedUrl = encodeURIComponent(pageUrl);
            const encodedTitle = encodeURIComponent(pageTitle);
            const encodedText = encodeURIComponent(pageMetadata.description || pageTitle || pageUrl);

            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodedText}%20${encodedUrl}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${encodedTitle}&body=${encodedText}%20${encodedUrl}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        });
    });
});
</script>
@endpush

